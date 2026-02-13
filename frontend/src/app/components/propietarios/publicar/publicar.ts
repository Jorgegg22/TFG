import { Component, OnInit } from '@angular/core';
import { PropietarioService } from '../../../services/propietarios-service';
import { UniversidadService } from '../../../services/universidades';

import { Router } from '@angular/router';
import { trigger, state, style, transition, animate } from '@angular/animations';
import { Universidad } from '../../../common/universidades-interface';

@Component({
  selector: 'app-publicar',
  standalone: false,
  templateUrl: './publicar.html',
  styleUrl: './publicar.css',
  animations: [
    trigger('enterInfo', [
      transition(':enter', [
        style({ opacity: 0, transform: 'translateY(20px)' }), // Aparece desde abajo
        animate('0.5s 0.2s ease-out', style({ opacity: 1, transform: 'translateY(0)' })), // Con un poco de delay (0.2s)
      ]),
      // Salida: Cuando la información vieja desaparece para dejar paso a la siguiente
    ]),
    trigger('enterExtraInfo', [
      transition(':enter', [
        style({ opacity: 0, transform: 'translateX(-20px)' }), // Aparece desde abajo
        animate('0.5s 0.2s ease-out', style({ opacity: 1, transform: 'translateY(0)' })), // Con un poco de delay (0.2s)
      ]),
      // Salida: Cuando la información vieja desaparece para dejar paso a la siguiente
    ]),

    
  ],
})
export class Publicar implements OnInit {
  inmData: {
    titulo: string;
    desc: string;
    direccion: string;
    precio: null;
    imagen_principal: string;
    imagen1: string;
    imagen2: string;
    imagen3: string;
    imagen4: string;
    metros: null;
    habitaciones: null;
    banios: null;
    n_personas: null;
    universidad_id: string;
  } = {
    titulo: '',
    desc: '',
    direccion: '',
    precio: null,
    imagen_principal: '',
    imagen1: '',
    imagen2: '',
    imagen3: '',
    imagen4: '',
    metros: null,
    habitaciones: null,
    banios: null,
    n_personas: null,
    universidad_id: '',
  };
  universidades: Universidad[] = [];
  capacidadValido: boolean = true;
  tituloValido: boolean = true;
  descValido: boolean = true;
  direccionValido: boolean = true;
  precioValido: boolean = true;
  metrosValido: boolean = true;
  habitacionesValido: boolean = true;
  baniosValido: boolean = true;
  personasValido: boolean = true; // Asegúrate de usar esta o capacidadValido consistentemente
  universidadValido: boolean = true;
  permitirBtnPost: boolean = false;

  ngOnInit(): void {
    this.loadUniversidadea();
  }

  constructor(
    private propService: PropietarioService,
    private uniService: UniversidadService,
    private router: Router,
  ) {}

  postInmueble() {
    this.propService.postInmueble(this.inmData).subscribe({
      next: (respuesta) => {
        this.router.navigate(['/inmuebles-propietario'],{
          queryParams: {añadido:'true'}
        })
      },
    });
  }

  loadUniversidadea() {
    this.uniService.getUniversidades().subscribe({
      next: (respuesta) => {
        this.universidades = respuesta;
        console.log(this.universidades);
      },
    });
  }

  validarTitulo() {
    if (!this.inmData.titulo || this.inmData.titulo.trim().length < 5) {
      this.tituloValido = false;
    }else{
      this.tituloValido = true;
    }

    this.permitirPost()

    
  }

  validarPrecio() {
    if (this.inmData.precio === null || this.inmData.precio <= 0) {
      this.precioValido = false;
    }else{
      this.precioValido = true;
    }

    this.permitirPost()
    
  }

  validarCapacidad() {
    if (this.inmData.n_personas === null || this.inmData.n_personas < 1) {
      this.capacidadValido = false;
    }else{
       this.capacidadValido = true;
    }
    this.permitirPost()

   
  }

  validarHabitaciones() {
    if (this.inmData.habitaciones === null || this.inmData.habitaciones < 0) {
      this.habitacionesValido = false;
    } else {
      this.habitacionesValido = true;
    }
    this.permitirPost();
  }

  validarBanios() {
    if (this.inmData.banios === null || this.inmData.banios < 0) {
      this.baniosValido = false;
    } else {
      this.baniosValido = true;
    }
    this.permitirPost();
  }

  validarMetros() {
    if (this.inmData.metros === null || this.inmData.metros <= 0) {
      this.metrosValido = false;
    } else {
      this.metrosValido = true;
    }

    this.permitirPost();
  }

  validarDescripcion() {
    if (!this.inmData.desc || this.inmData.desc.trim().length < 20) {
      this.descValido = false;
    } else {
      this.descValido = true;
    }

    this.permitirPost();
  }

  validarUniversidad() {
    if (!this.inmData.universidad_id) {
      this.universidadValido = false;
    } else {
      this.universidadValido = true;
    }
    this.permitirPost();
  }

  validarDireccion() {
    if (!this.inmData.direccion || this.inmData.direccion.trim().length < 10) {
      this.direccionValido = false;
    } else {
      this.direccionValido = true;
    }

    this.permitirPost();
  }

  permitirPost() {
    if (
      this.direccionValido &&
      this.universidadValido &&
      this.descValido &&
      this.metrosValido &&
      this.baniosValido &&
      this.habitacionesValido &&
      this.capacidadValido &&
      this.precioValido &&
      this.tituloValido
    ) {
      this.permitirBtnPost = true;
    } else {
      this.permitirBtnPost = false;
    }
  }

  limpiar() {
  this.inmData = {
    titulo: '',
    desc: '',
    direccion: '',
    precio: null,
    imagen_principal: '',
    imagen1: '',
    imagen2: '',
    imagen3: '',
    imagen4: '',
    metros: null,
    habitaciones: null,
    banios: null,
    n_personas: null,
    universidad_id: '',
  };

  this.capacidadValido = true;
  this.tituloValido = true;
  this.descValido = true;
  this.direccionValido = true;
  this.precioValido = true;
  this.metrosValido = true;
  this.habitacionesValido = true;
  this.baniosValido = true;
  this.personasValido = true;
  this.universidadValido = true;
  
  this.permitirBtnPost = false;
}
}
