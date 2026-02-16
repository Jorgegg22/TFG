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
  
    ]),
    trigger('enterExtraInfo', [
      transition(':enter', [
        style({ opacity: 0, transform: 'translateX(-20px)' }), // Aparece desde abajo
        animate('0.5s 0.2s ease-out', style({ opacity: 1, transform: 'translateY(0)' })), // Con un poco de delay (0.2s)
      ]),
  
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
  capacidadValido: boolean = false;
  tituloValido: boolean = false;
  descValido: boolean = false;
  direccionValido: boolean = false;
  precioValido: boolean = false;
  metrosValido: boolean = false;
  habitacionesValido: boolean = false;
  baniosValido: boolean = false;
  imagen_principalValido: boolean = false;
  imagen1Valido: boolean = false;
  imagen2Valido: boolean = false;
  imagen3Valido: boolean = false;
  imagen4Valido: boolean = false;

  personasValido: boolean = true; 
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
        this.router.navigate(['/inmuebles-propietario'], {
          queryParams: { añadido: 'true' },
        });
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
    } else {
      this.tituloValido = true;
    }

    this.permitirPost();
  }

  validarPrecio() {
    if (this.inmData.precio === null || this.inmData.precio <= 0) {
      this.precioValido = false;
    } else {
      this.precioValido = true;
    }

    this.permitirPost();
  }

  validarCapacidad() {
    if (this.inmData.n_personas === null || this.inmData.n_personas < 1) {
      this.capacidadValido = false;
    } else {
      this.capacidadValido = true;
    }
    this.permitirPost();
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

  validarImagenPrincipal(event: any) {
    const file = event.target.files[0];
    if (file) {
      this.imagen_principalValido = true;
      // TRADUCTOR DE IMAGENES PARA MANDAR EL CONTENIDO DE LA IMAGEN
      const reader = new FileReader();

      // ESPERA A QUE TERMINE READASDATAURL,PARA APLICARLE EL RESULTADO EN STRING A USERDATA
      reader.onload = () => {
        this.inmData.imagen_principal = reader.result as string;
        this.permitirPost();
      };
      reader.readAsDataURL(file);
    } else {
      this.imagen_principalValido = false;
      this.permitirPost();
    }
  }

  validarImagenUno(event: any) {
    const file = event.target.files[0];
    if (file) {
      this.imagen1Valido = true;
      // TRADUCTOR DE IMAGENES PARA MANDAR EL CONTENIDO DE LA IMAGEN
      const reader = new FileReader();

      // ESPERA A QUE TERMINE READASDATAURL,PARA APLICARLE EL RESULTADO EN STRING A USERDATA
      reader.onload = () => {
        this.inmData.imagen1 = reader.result as string;
        this.permitirPost();
      };
      reader.readAsDataURL(file);
    } else {
      this.imagen1Valido = false;
      this.permitirPost();
    }
  }
  validarImagenDos(event: any) {
    const file = event.target.files[0];
    if (file) {
      this.imagen2Valido = true;
      // TRADUCTOR DE IMAGENES PARA MANDAR EL CONTENIDO DE LA IMAGEN
      const reader = new FileReader();

      // ESPERA A QUE TERMINE READASDATAURL,PARA APLICARLE EL RESULTADO EN STRING A USERDATA
      reader.onload = () => {
        this.inmData.imagen2 = reader.result as string;
        this.permitirPost();
      };
      reader.readAsDataURL(file);
    } else {
      this.imagen2Valido = false;
      this.permitirPost();
    }
  }
  validarImagenTres(event: any) {
    const file = event.target.files[0];
    if (file) {
      this.imagen3Valido = true;
      // TRADUCTOR DE IMAGENES PARA MANDAR EL CONTENIDO DE LA IMAGEN
      const reader = new FileReader();

      // ESPERA A QUE TERMINE READASDATAURL,PARA APLICARLE EL RESULTADO EN STRING A USERDATA
      reader.onload = () => {
        this.inmData.imagen3 = reader.result as string;
        this.permitirPost();
      };
      reader.readAsDataURL(file);
    } else {
      this.imagen3Valido = false;
      this.permitirPost();
    }
  }
  validarImagenCuatro(event: any) {
    const file = event.target.files[0];
    if (file) {
      this.imagen4Valido = true;
      // TRADUCTOR DE IMAGENES PARA MANDAR EL CONTENIDO DE LA IMAGEN
      const reader = new FileReader();

      // ESPERA A QUE TERMINE READASDATAURL,PARA APLICARLE EL RESULTADO EN STRING A USERDATA
      reader.onload = () => {
        this.inmData.imagen4 = reader.result as string;
        this.permitirPost();
      };
      reader.readAsDataURL(file);
    } else {
      this.imagen4Valido = false;
      this.permitirPost();
    }
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
      this.tituloValido &&
      this.imagen1Valido &&
      this.imagen2Valido &&
      this.imagen3Valido &&
      this.imagen4Valido &&
      this.imagen_principalValido
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
