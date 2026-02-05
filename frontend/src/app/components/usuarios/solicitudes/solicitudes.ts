import { Component, OnInit } from '@angular/core';
import { UsuarioService } from '../../../services/usuarios-service';
import { Solicitud, Data ,Inmueble} from '../../../common/solicitudes-interface';
import { isIterable } from 'rxjs/internal/util/isIterable';

@Component({
  selector: 'app-solicitudes',
  standalone: false,
  templateUrl: './solicitudes.html',
  styleUrl: './solicitudes.css',
})
export class Solicitudes implements OnInit {
  userData: { userId: string | null } = {
    userId: null
  };

  info!:Solicitud 
  allInmuebles: Inmueble[] = [];
  inmuebles:Inmueble[] = [];
  inmPerPage: number = 6;
  totalPages!: number;
  currentPage: number = 1;
  initialSlice!:number;
  finalSlice!:number;

  ngOnInit(): void {

    const sesionGuardada = localStorage.getItem('sesion');
    
    if (sesionGuardada) {

      const usuarioObj = JSON.parse(sesionGuardada);
      
      this.userData.userId = usuarioObj.id;
    }
    this.loadSolicitudes();
  }

  constructor(private userService: UsuarioService) {}

  loadSolicitudes() {
    this.userService.getSolicitudesUsuario(this.userData).subscribe({
      next: (respuesta) => {
        console.log(respuesta);
        this.info = respuesta;
        this.allInmuebles = this.info.data.inmuebles;
        this.inmuebles = this.info.data.inmuebles;
        this.totalPages = Math.ceil(this.inmuebles.length/this.inmPerPage);
        console.log(this.inmuebles);
        this.pagination();

        
        
      },
      error: (err) => console.error('Error', err),
    });
  }



  pagination(){
    this.initialSlice = (this.currentPage * this.inmPerPage) - this.inmPerPage;
    this.finalSlice = this.inmPerPage + this.initialSlice;
    this.inmuebles = this.allInmuebles.slice(this.initialSlice,this.finalSlice);
  }

}
