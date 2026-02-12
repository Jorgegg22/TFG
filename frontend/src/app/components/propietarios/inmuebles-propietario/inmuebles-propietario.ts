import { Component, OnInit } from '@angular/core';
import { ListaInmuebles } from '../../../common/inmuebles-interface';
import { PropietarioService } from '../../../services/propietarios-service';

@Component({
  selector: 'app-inmuebles-propietario',
  standalone: false,
  templateUrl: './inmuebles-propietario.html',
  styleUrl: './inmuebles-propietario.css',
})
export class InmueblesPropietario implements OnInit {
  allInmuebles: ListaInmuebles = [];
  inmuebles: ListaInmuebles = [];
  totalPages!: number;
  elementsPerPage: any;
  currentPage: number = 1;
  urlImagenes = 'http://localhost:8080/uploads/inmuebles_fotos/';
  inmPerPage: number = 6;
  initialSlice!: number;
  finalSlice!: number;
  mostratPaginacion: any;
  loading: boolean = true;
  info: boolean = false;

  constructor(private propService: PropietarioService) {}

  ngOnInit(): void {
    this.loadInmuebles();
  }

  loadInmuebles() {
    this.propService.getInmueblesPropietario().subscribe({
      next: (respuesta: any) => {
        console.log(respuesta);
        this.allInmuebles = respuesta;
        if (this.allInmuebles.length === 0) {
          this.info = false;
          this.mostratPaginacion = false;
        } else {
          this.info = true;
          this.mostratPaginacion = true;
          this.totalPages = Math.ceil(this.allInmuebles.length / this.elementsPerPage);
          console.log(this.totalPages);
          console.log(this.allInmuebles.length);
          this.pagination();
        }
        this.loading = false;
      },
    });
  }
  pagination() {
    this.initialSlice = this.currentPage * this.inmPerPage - this.inmPerPage;
    this.finalSlice = this.inmPerPage + this.initialSlice;
    this.inmuebles = this.allInmuebles.slice(this.initialSlice, this.finalSlice);
  }

  nextPage() {
    if (this.currentPage < this.totalPages) {
      this.currentPage++;
      this.pagination();
    }
  }

  prevPage() {
    if (this.currentPage > 1) {
      this.currentPage--;
      this.pagination();
    }
  }

  goToPage(page: number) {
    this.currentPage = page;
    this.pagination();
  }
}
