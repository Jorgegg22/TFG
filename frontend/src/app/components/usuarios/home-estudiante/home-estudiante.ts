import { Component, OnInit } from '@angular/core';
import { trigger, state, style, transition, animate } from '@angular/animations';
import { InmuebleService } from '../../../services/inmuebles-service';
import { Inmueble } from '../../../common/inmuebles-interface';

@Component({
  selector: 'app-home-estudiante',
  standalone: false,
  templateUrl: './home-estudiante.html',
  styleUrl: './home-estudiante.css',
  animations: [
    trigger('swipeAnimacion', [
      // Animaciones Like/Dislike
      state(
        'derecha',
        style({
          transform: 'translateX(200%) rotate(30deg)',
          opacity: 0,
        }),
      ),
   
      state(
        'izquierda',
        style({
          transform: 'translateX(-200%) rotate(-30deg)',
          opacity: 0,
        }),
      ),
      // Transiciones de los dos estados
      transition('* => derecha', [animate('0.8s ease-out')]),
      transition('* => izquierda', [animate('0.8s ease-out')]),

      // * significa estado
      transition(':enter', [
        style({ opacity: 0, transform: 'scale(0.95)' }), 
        animate('0.3s ease-in', style({ opacity: 1, transform: 'scale(1)' })), 
      ]),
    ]),

    trigger('enterInfo', [
      transition(':enter', [
        style({ opacity: 0, transform: 'translateY(20px)' }), 
        animate('0.5s 0.2s ease-out', style({ opacity: 1, transform: 'translateY(0)' })), 
      ]),
      // Salida
      transition('* => derecha, * => izquierda', [
        animate('1.8s ease-in', style({ opacity: 0, transform: 'translateY(-400px)' })),
      ]),
    ]),
  ],
})
export class HomeEstudiante implements OnInit {
  options: boolean = false;
  infoFiltrada: Inmueble[] = [];
  infoFiltradaUni: Inmueble[] = [];
  infoAleatoria: Inmueble[] = [];
  inmuebles!: Inmueble;
  index: number = 0;
  index2: number = 0;
  index3: number = 0;
  $idCasaLike!: number;
  idsInteractuados: number[] = [];
  noInfo: boolean = false;
  loading: boolean = true;
  datosCargados: number = 0;

  urlImagenes = 'http://localhost:8080/uploads/inmuebles_fotos/';
  estadoAnimacion: string | null = null;
  mostrandoCard: boolean = true;

  constructor(private imbService: InmuebleService) {}

  ngOnInit(): void {
    this.getInmuebles();
    this.getInmueblesFiltradoUni();
    this.getInmueblesAleatorios();

    setTimeout(() => {
      this.loading = false;
      this.loadInmueble();
    }, 500);
  }

  cargados() {
    this.datosCargados++;
    if (this.datosCargados === 3) {
      this.loading = false;
      this.loadInmueble();
    }
  }

  getInmuebles() {
    this.imbService.getInmueblesFiltrados().subscribe({
      next: (respuesta) => {
        console.log('Filtro Todo');
        this.infoFiltrada = respuesta;
        console.log(this.infoFiltrada);
        this.cargados();
      },
      error: (err) => console.error('Error', err),
    });
  }

  getInmueblesFiltradoUni() {
    this.imbService.getInmueblesFiltradoUniversidad().subscribe({
      next: (respuesta) => {
        console.log('Filtro Uni');

        this.infoFiltradaUni = respuesta;
        console.log(this.infoFiltradaUni);
        this.cargados();
      },
    });
  }

  getInmueblesAleatorios() {
    this.imbService.getInmueblesAleatorios().subscribe({
      next: (respuesta) => {
        console.log('Sin filtro');
        this.infoAleatoria = respuesta;
        console.log(this.infoAleatoria);
        this.cargados();
      },
      error: (err) => console.error('Error', err),
    });
  }

  loadInmueble() {
    if (this.index < this.infoFiltrada.length) {
      console.log('Empieza Filtro por Todo');
      if (this.idsInteractuados.includes(this.infoFiltrada[this.index]['id'])) {
        this.index++;
        this.loadInmueble();
      } else {
        this.inmuebles = this.infoFiltrada[this.index];
      }
    } else if (this.index2 < this.infoFiltradaUni.length) {
      console.log('Empieza Filtro por Universidad');
      if (this.idsInteractuados.includes(this.infoFiltradaUni[this.index2]['id'])) {
        this.index2++;
        this.loadInmueble();
      } else {
        this.inmuebles = this.infoFiltradaUni[this.index2];
      }
    } else if (this.index3 < this.infoAleatoria.length) {
      console.log('Empieza lista sin Filtro');
      if (this.idsInteractuados.includes(this.infoAleatoria[this.index3]['id'])) {
        this.index3++;
        this.loadInmueble();
      } else {
        this.inmuebles = this.infoAleatoria[this.index3];
      }
    } else {
      console.log('No quedan más casas por mostrar');
      this.noInfo = true;
    }
  }

  postSolicitud($id: number) {
    this.imbService.postSolicitud($id).subscribe({
      next: (respuesta) => {
        console.log(respuesta);
      },
    });
  }

  showOptions() {
    this.options = !this.options;
  }

  nextHouseLike() {
    if (this.index < this.infoFiltrada.length) {
      this.$idCasaLike = this.infoFiltrada[this.index]['id'];
      this.index++;
    } else if (this.index2 < this.infoFiltradaUni.length) {
      this.$idCasaLike = this.infoFiltradaUni[this.index2]['id'];
      this.index2++;
    } else {
      this.$idCasaLike = this.infoAleatoria[this.index3]['id'];
      this.index3++;
    }

    console.log(this.$idCasaLike);
    this.idsInteractuados.push(this.$idCasaLike);

    this.postSolicitud(this.$idCasaLike);
    this.loadInmueble();
  }

  nextHouseDislike() {
    if (this.index < this.infoFiltrada.length) {
      this.index++;
    } else if (this.index2 < this.infoFiltradaUni.length) {
      this.index2++;
    } else {
      this.index3++;
    }

    this.loadInmueble();
  }

  iniciarAnimacion(direccion: 'izquierda' | 'derecha') {
    this.estadoAnimacion = direccion;
    setTimeout(() => {
      this.mostrandoCard = false;
      if (direccion === 'derecha') {
        this.nextHouseLike();
      } else {
        this.nextHouseDislike();
      }
      setTimeout(() => {
        this.estadoAnimacion = null; // Reseteamos posición
        this.mostrandoCard = true; // 3. Creamos la tarjeta nueva (dispara :enter)
      }, 50);
    }, 1200);
  }
}
