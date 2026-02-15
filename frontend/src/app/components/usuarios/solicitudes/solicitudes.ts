import { Component, OnInit, Injectable } from '@angular/core';
import { UsuarioService } from '../../../services/usuarios-service';
import { SolicitudResponse, Data, Inmueble } from '../../../common/solicitudes-interface';
import { isIterable } from 'rxjs/internal/util/isIterable';
import { trigger, state, style, transition, animate } from '@angular/animations';

@Component({
  selector: 'app-solicitudes',
  standalone: false,
  templateUrl: './solicitudes.html',
  styleUrl: './solicitudes.css',
  animations: [
    trigger('enterInfo', [
      transition(':enter', [
        style({ opacity: 0, transform: 'translateY(20px)' }), // Aparece desde abajo
        animate('0.5s 0.2s ease-out', style({ opacity: 1, transform: 'translateY(0)' })), // Con un poco de delay (0.2s)
      ]),
      transition(':leave', [
        animate(
          '0.1s ease-in',
          style({
            opacity: 0,
            transform: 'scale(0.8)', // Se encoge un poco
            marginRight: '-20px', // Ayuda a que el hueco se cierre
            filter: 'grayscale(1)', // Se pone gris mientras se va
          }),
        ),
      ]),

    ]),

    trigger('enterPost', [
      // Entrada desde la izquierda
      transition(':enter', [
        style({ opacity: 0, transform: 'translateX(100%)' }),
        animate('0.5s ease-out', style({ opacity: 1, transform: 'translateX(0)' })),
      ]),
      // Salida con FadeOut (desvanecimiento)
      transition(':leave', [animate('0.4s ease-in', style({ opacity: 0 }))]),
    ]),
  ],
})

@Injectable({
  providedIn: 'root'
})
export class Solicitudes implements OnInit {
  userData: { userId: string | null } = {
    userId: null,
  };

  info!: SolicitudResponse;
  allInmuebles: Inmueble[] = [];
  inmuebles: Inmueble[] = [];

  inmPerPage: number = 6;
  totalPages!: number;
  currentPage: number = 1;
  initialSlice!: number;
  finalSlice!: number;
  noInfo: boolean = false;
  loading: boolean = true;
  exitoDeleteSolicitud: boolean = false;

  valorEstado: string = 'todos';
  mostratPaginacion: boolean = false;

  urlImagenes = 'http://localhost:8080/uploads/inmuebles_fotos/';
  //urlImagenes = 'http://localhost/univibe/backend/public/uploads/inmuebles_fotos/';

  ngOnInit(): void {
    this.loadSolicitudes();
  }

  constructor(private userService: UsuarioService) {}

  loadSolicitudes() {
    this.userService.getSolicitudesUsuario().subscribe({
      next: (respuesta) => {
        console.log(respuesta);
        this.info = respuesta;
        this.allInmuebles = this.info.data.inmuebles;
        console.log(this.allInmuebles);

        if (this.allInmuebles.length === 0) {
          this.noInfo = true;
        } else {
          this.noInfo = false;
          this.mostratPaginacion = true;
          this.inmuebles = this.allInmuebles;
          this.totalPages = Math.ceil(this.inmuebles.length / this.inmPerPage);
          console.log('inmuebles');

          console.log(this.inmuebles);
          this.pagination();
        }
        this.loading = false;
      },
      error: (err) => console.error('Error', err),
    });
  }

  pagination(lista?: Inmueble[]) {
    this.initialSlice = this.currentPage * this.inmPerPage - this.inmPerPage;
    this.finalSlice = this.inmPerPage + this.initialSlice;
    if (lista) {
      this.inmuebles = lista.slice(this.initialSlice, this.finalSlice);
    } else {
      this.inmuebles = this.allInmuebles.slice(this.initialSlice, this.finalSlice);
    }
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

  filterEstado() {
    if (this.valorEstado === 'todos') {
      this.inmuebles = this.allInmuebles;
    } else {
      this.inmuebles = this.allInmuebles.filter((inm) => inm.estado_solicitud === this.valorEstado);
    }

    if (this.inmuebles.length === 0) {
      this.mostratPaginacion = false;
    } else {
      this.mostratPaginacion = true;
      this.currentPage = 1;
      this.totalPages = Math.ceil(this.inmuebles.length / this.inmPerPage);
      this.pagination(this.inmuebles);
    }
  }

  quitarSolicitud(id: string) {
    const data = {
      idSol: id,
    };
    this.userService.eliminarSolicitud(data).subscribe({
      next: (respuesta) => {
        this.exitoDeleteSolicitud = true;
        this.allInmuebles = this.allInmuebles.filter((inm) => inm.solicitud_id !== data.idSol);
        this.filterEstado();
        setTimeout(() => {
          this.exitoDeleteSolicitud = false;
        }, 6000);
      },
      error: (err) => console.error('Error en el servidor:', err),
    });
  }
}
