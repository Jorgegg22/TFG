import { Component, OnInit } from '@angular/core';
import { InmuebleService } from '../../../services/inmuebles-service';
import { Inmueble } from '../../../common/inmuebles-interface';
import { InmuebleAleatorio } from '../../../common/inmueblesAleatorios-interface';

@Component({
  selector: 'app-home-estudiante',
  standalone: false,
  templateUrl: './home-estudiante.html',
  styleUrl: './home-estudiante.css',
})
export class HomeEstudiante implements OnInit {
  options: boolean = false;
  infoFiltrada: Inmueble[] = [];
  infoAleatoria: InmuebleAleatorio[] = [];
  inmuebles!: Inmueble;
  index: number = 0;
  index2: number = 0;

  constructor(private imbService: InmuebleService) {}

  ngOnInit(): void {
    this.getInmuebles();
    this.getInmueblesAleatorios();
  }

  getInmuebles() {
    this.imbService.getInmuebles().subscribe({
      next: (respuesta) => {
        console.log('lista filtrada');
        console.log(respuesta);
        this.infoFiltrada = respuesta;
        console.log(this.infoFiltrada[this.index]);
        this.loadInmueble();
      },
      error: (err) => console.error('Error', err),
    });
  }

  getInmueblesAleatorios() {
    this.imbService.getInmueblesAleatorios().subscribe({
      next: (respuesta) => {
        console.log('Lista aleatoria');
        console.log(respuesta);
        this.infoAleatoria = respuesta;
        console.log(this.infoAleatoria[this.index]);
        this.loadInmueble();
      },
      error: (err) => console.error('Error', err),
    });
  }

  loadInmueble() {
    if (this.index < this.infoFiltrada.length) {
      this.inmuebles = this.infoFiltrada[this.index];
    }else if(this.infoAleatoria){
      this.inmuebles = this.infoFiltrada[this.index2]
    }
  }

  showOptions() {
    this.options = !this.options;
  }

  nextHouseLike() {
   if (this.index < this.infoFiltrada.length) {
      this.index++;
    } else {
      this.index2++;
    }
    
    this.loadInmueble();
  }

  nextHouseDislike() {
    if (this.index < this.infoFiltrada.length) {
      this.index++;
    } else {
      this.index2++;
    }
    
    this.loadInmueble();
  }
}
