import { Component, OnInit } from '@angular/core';
import { InmuebleService } from '../../../services/inmuebles-service';
import { Inmueble } from '../../../common/inmuebles-interface';

@Component({
  selector: 'app-home-estudiante',
  standalone: false,
  templateUrl: './home-estudiante.html',
  styleUrl: './home-estudiante.css',
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

  constructor(private imbService: InmuebleService) {}

  ngOnInit(): void {
    this.getInmuebles();
    this.getInmueblesFiltradoUni();
    this.getInmueblesAleatorios();
  }

  getInmuebles() {
    this.imbService.getInmueblesFiltrados().subscribe({
      next: (respuesta) => {
        console.log('Filtro Todo');
        this.infoFiltrada = respuesta;
        console.log(this.infoFiltrada);
        this.loadInmueble();
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
        this.loadInmueble();
      },
    });
  }

  getInmueblesAleatorios() {
    this.imbService.getInmueblesAleatorios().subscribe({
      next: (respuesta) => {
        console.log('Sin filtro');
        this.infoAleatoria = respuesta;
        console.log(this.infoAleatoria);
        this.loadInmueble();
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
    }
  }

  postSolicitud($id:number){
    this.imbService.postSolicitud($id).subscribe({
      next:(respuesta) =>{
              console.log(respuesta)
      }

      
    })
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
}
