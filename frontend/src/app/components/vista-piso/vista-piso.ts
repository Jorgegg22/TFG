import { Component, OnInit } from '@angular/core';
import { InmuebleService } from '../../services/inmuebles-service';
import { ActivatedRoute, Router } from '@angular/router';
import { InmuebleDetalle, Solicitud, Match } from '../../common/pisoDetalle-interface';
import { trigger, state, style, transition, animate } from '@angular/animations';
import { Location } from '@angular/common';
import { PropietarioService } from '../../services/propietarios-service';
import { Universidad } from '../../common/universidades-interface';
import { UniversidadService } from '../../services/universidades';
@Component({
  selector: 'app-vista-piso',
  standalone: false,
  templateUrl: './vista-piso.html',
  styleUrl: './vista-piso.css',
  animations: [
    trigger('enterAnimation', [
      // Animaciones Like/Dislike
      // (* significa estado
      transition(':enter', [
        style({ opacity: 0, transform: 'scale(0.95)' }),
        animate('0.3s ease-in', style({ opacity: 1, transform: 'scale(1)' })),
      ]),
    ]),

    trigger('modalAnimation', [
      // 1. Entrada: Aparece y crece un poco (efecto Pop)
      transition(':enter', [
        style({ opacity: 0, transform: 'scale(0.8)' }), // Empieza transparente y al 80% de tamaño
        animate('300ms ease-out', style({ opacity: 1, transform: 'scale(1)' })), // Termina visible y tamaño normal
      ]),

      // 2. Salida: Desaparece y se encoge (efecto Receder)
      transition(':leave', [
        style({ opacity: 1, transform: 'scale(1)' }), // (Opcional) Estado inicial explícito
        animate('200ms ease-in', style({ opacity: 0, transform: 'scale(0.8)' })), // Se va a transparente y pequeño
      ]),
    ]),

    trigger('modalAnimationMatch', [
      // 1. Entrada: Aparece y crece un poco (efecto Pop)
      transition(':enter', [
        style({ opacity: 0, transform: 'translateX(100%)' }),
        animate('0.5s ease-out', style({ opacity: 1, transform: 'translateX(0)' })),
      ]),
      // Salida con FadeOut (desvanecimiento)
      transition(':leave', [animate('0.4s ease-in', style({ opacity: 0 }))]),
    ]),
  ],
})
export class VistaPiso implements OnInit {
  idInmueble!: string;
  unis: Universidad[] = [];
  info!: InmuebleDetalle;
  infoBackUp!: InmuebleDetalle;
  solicitudes: Solicitud[] = [];
  matches: Match[] = [];
  previousUrl!: string | null;
  edit: boolean = false;
  loading: boolean = true;
  sesionNombre!: string;
  sesionNombreItem!: any;
  huecosDisponibles!: number;
  imgSrc!: string;
  mostrarModal: boolean = false;
  mostrarConfirmarBorrado: boolean = false;
  mostrarModalMatch: boolean = false;
  estudianteAceptadoNombre: string = '';
  estudianteAceptadoFoto: string = '';
  isEditing: boolean = false;

  urlImagenes = 'http://localhost:8080/uploads/inmuebles_fotos/';
  //urlImagenes = 'http://localhost/univibe/backend/public/uploads/inmuebles_fotos/';

  urlImagenesPerfil = 'http://localhost:8080/uploads/perfiles/';
  mostrarModalRechazo: any;
  tituloValido: boolean = true;
  precioValido: boolean = true;
  capacidadValido: boolean = true;
  habitacionesValido: boolean = true;
  baniosValido: boolean = true;
  metrosValido: boolean = true;
  descValido: boolean = true;
  universidadValido: boolean = true;
  direccionValido: boolean = true;
  imagen_principalValido: boolean = false;

  nuevoTitulo: boolean = true;
  nuevoPrecio: boolean = true;
  nuevoCapacidad: boolean = true;
  nuevoHabitaciones: boolean = true;
  nuevoBanios: boolean = true;
  nuevoMetros: boolean = true;
  nuevoDesc: boolean = true;
  nuevoDireccion: boolean = true;
  nuevaFotoPrincipal: boolean = false;
  nuevaFoto1: boolean = false;
  nuevaFoto2: boolean = false;
  nuevaFoto3: boolean = false;
  nuevaFoto4: boolean = false;

  permitirBtnPost: boolean = false;

  ngOnInit(): void {
    this.loadInmueble();
  }

  constructor(
    private inmService: InmuebleService,
    private propService: PropietarioService,
    private activatedRoute: ActivatedRoute,
    private uniService: UniversidadService,
    private location: Location,
    private router: Router,
  ) {}

  loadInmueble() {
    this.idInmueble = this.activatedRoute.snapshot.params['id'];
    this.inmService.getInmueble(this.idInmueble).subscribe({
      next: (respuesta) => {
        console.log('hay piso');
        this.info = respuesta;
        // NUEVO OBJETO RESPUESTA PARA NO CAMBIAR VALOR
        this.infoBackUp = { ...respuesta };

        this.solicitudes = this.info.solicitudes;
        this.solicitudes = this.solicitudes.filter((s) => s.estado === 'interesado');

        this.matches = this.info.matches;
        console.log(this.info);
        console.log(this.solicitudes);
        console.log(this.matches);
        console.log(this.info.nombre_propietario);
        const sesionStr = localStorage.getItem('sesion');
        const sesionObj = JSON.parse(sesionStr || '{}');
        this.sesionNombre = sesionObj.nombre;
        console.log(this.sesionNombre);

        if (this.info.nombre_propietario === this.sesionNombre) {
          this.edit = true;
        }

        console.log(this.info.n_personas);
        let numeroMatches = this.matches.length;
        console.log(numeroMatches);
        this.huecosDisponibles = parseInt(this.info.n_personas) - numeroMatches;

        this.loading = false;
      },
    });
  }

  onClickImagen(event: PointerEvent) {
    var target = event.target as any;
    var srcAttr = target.attributes.src;
    this.imgSrc = srcAttr.nodeValue;
    this.mostrarModal = true;
  }

  cerrarModal() {
    console.log('cerrando');
    this.mostrarModal = false;
  }

  volver() {
    this.location.back();
  }

  confirmar() {
    this.mostrarConfirmarBorrado = true;
  }

  eliminarPiso() {
    this.propService.deleteInmueble(this.idInmueble).subscribe({
      next: (respuesta) => {
        this.router.navigate(['/inmuebles-propietario'], {
          queryParams: { eliminado: 'true' },
        });
      },
    });
  }

  match(sol: any) {
    const data = {
      solicitud_id: sol.id,
      estudiante_id: sol.estudiante_id,
      inmueble_id: this.idInmueble,
    };

    this.propService.crearMatch(data).subscribe({
      next: (respuesta) => {
        this.solicitudes = this.solicitudes.filter((s) => s.id !== sol.id);

        const nuevoMatch: Match = {
          id: '0',
          estudiante_id: sol.estudiante_id,
          inmueble_id: this.idInmueble,
          created_at: new Date().toISOString(),
          nombre_estudiante: sol.nombre_solicitante,
          foto_perfil: sol.foto_perfil,
        };

        this.matches.push(nuevoMatch);

        this.huecosDisponibles--;

        this.estudianteAceptadoNombre = sol.nombre_solicitante;
        this.estudianteAceptadoFoto = sol.foto_perfil;
        this.mostrarModalMatch = true;
      },
      error: (err) => console.error(err),
    });
  }

  eliminarSolicitud(sol: any) {
    const data = {
      solicitud_id: sol.id,
    };

    this.propService.eliminarSolicitud(data).subscribe({
      next: (respuesta) => {
        this.solicitudes = this.solicitudes.filter((s) => s.id !== sol.id);
        this.estudianteAceptadoNombre = sol.nombre_solicitante;
        this.estudianteAceptadoFoto = sol.foto_perfil;
        this.mostrarModalRechazo = true;
      },
    });
  }

  editar() {
    this.isEditing = !this.isEditing;
    this.loadUniversidades();
  }

  cancelarEdicion() {
    this.isEditing = false;
    this.loadInmueble();
  }

  loadUniversidades() {
    this.uniService.getUniversidades().subscribe({
      next: (respuesta) => {
        console.log(respuesta);
        this.unis = respuesta;
      },
      error: (err) => {
        console.error(err);
      },
    });
  }

  validarTitulo() {
    if (this.info.titulo.trim().length < 5 && this.info.titulo !== this.infoBackUp.titulo) {
      this.tituloValido = false;
    } else {
      this.tituloValido = true;
    }

    this.permitirPost();
  }

  validarCapacidad() {
    if (parseInt(this.info.n_personas) < 1 && this.info.n_personas !== this.infoBackUp.n_personas) {
      this.capacidadValido = false;
    } else {
      this.capacidadValido = true;
    }
    this.permitirPost();
  }

  validarHabitaciones() {
    if (
      parseInt(this.info.habitaciones) < 0 &&
      this.info.habitaciones !== this.infoBackUp.habitaciones
    ) {
      this.habitacionesValido = false;
    } else {
      this.habitacionesValido = true;
    }
    this.permitirPost();
  }

  validarBanios() {
    if (parseInt(this.info.banios) < 0 && this.info.banios !== this.infoBackUp.banios) {
      this.baniosValido = false;
    } else {
      this.baniosValido = true;
    }
    this.permitirPost();
  }

  validarMetros() {
    if (parseInt(this.infoBackUp.metros) <= 0 && this.info.metros !== this.infoBackUp.metros) {
      this.metrosValido = false;
    } else {
      this.metrosValido = true;
    }

    this.permitirPost();
  }

  validarDescripcion() {
    if (
      this.info.descripcion.trim().length < 20 &&
      this.info.descripcion !== this.infoBackUp.descripcion
    ) {
      this.descValido = false;
    } else {
      this.descValido = true;
    }

    this.permitirPost();
  }

  validarUniversidad() {
    if (!this.info.universidad_id && this.info.universidad_id !== this.infoBackUp.universidad_id) {
      this.universidadValido = false;
    } else {
      this.universidadValido = true;
    }
    this.permitirPost();
  }

  validarDireccion() {
    if (
      this.info.direccion.trim().length < 10 &&
      this.info.direccion !== this.infoBackUp.direccion
    ) {
      this.direccionValido = false;
    } else {
      this.direccionValido = true;
    }

    this.permitirPost();
  }

  validarImagenPrincipal(event: any) {
    const file = event.target.files[0];
    if (file) {
      // TRADUCTOR DE IMAGENES PARA MANDAR EL CONTENIDO DE LA IMAGEN
      const reader = new FileReader();

      // ESPERA A QUE TERMINE READASDATAURL,PARA APLICARLE EL RESULTADO EN STRING A USERDATA
      reader.onload = () => {
        this.info.imagen_principal = reader.result as string;
        this.nuevaFotoPrincipal = true;
        this.permitirPost();
      };
      reader.readAsDataURL(file);
    } else {
      this.info.imagen_principal = this.infoBackUp.imagen_principal;
      this.nuevaFotoPrincipal = false;
      this.permitirPost();
    }
  }

  validarImagenUno(event: any) {
    const file = event.target.files[0];
    if (file) {
      // TRADUCTOR DE IMAGENES PARA MANDAR EL CONTENIDO DE LA IMAGEN
      const reader = new FileReader();

      // ESPERA A QUE TERMINE READASDATAURL,PARA APLICARLE EL RESULTADO EN STRING A USERDATA
      reader.onload = () => {
        this.info.imagen1 = reader.result as string;
        this.nuevaFoto1 = true;
        this.permitirPost();
      };
      reader.readAsDataURL(file);
    } else {
      this.info.imagen1 = this.infoBackUp.imagen1;
      this.nuevaFoto1 = false;
      this.permitirPost();
    }
  }
  validarImagenDos(event: any) {
    const file = event.target.files[0];
    if (file) {
      // TRADUCTOR DE IMAGENES PARA MANDAR EL CONTENIDO DE LA IMAGEN
      const reader = new FileReader();

      // ESPERA A QUE TERMINE READASDATAURL,PARA APLICARLE EL RESULTADO EN STRING A USERDATA
      reader.onload = () => {
        this.info.imagen2 = reader.result as string;
        this.nuevaFoto2 = true;
        this.permitirPost();
      };
      reader.readAsDataURL(file);
    } else {
      this.info.imagen2 = this.infoBackUp.imagen2;
      this.nuevaFoto2 = false;
      this.permitirPost();
    }
  }
  validarImagenTres(event: any) {
    const file = event.target.files[0];
    if (file) {
      // TRADUCTOR DE IMAGENES PARA MANDAR EL CONTENIDO DE LA IMAGEN
      const reader = new FileReader();

      // ESPERA A QUE TERMINE READASDATAURL,PARA APLICARLE EL RESULTADO EN STRING A USERDATA
      reader.onload = () => {
        this.info.imagen3 = reader.result as string;
        this.nuevaFoto3 = true;
        this.permitirPost();
      };
      reader.readAsDataURL(file);
    } else {
      this.info.imagen3 = this.infoBackUp.imagen3;
      this.nuevaFoto3 = false;
      this.permitirPost();
    }
  }
  validarImagenCuatro(event: any) {
    const file = event.target.files[0];
    if (file) {
      // TRADUCTOR DE IMAGENES PARA MANDAR EL CONTENIDO DE LA IMAGEN
      const reader = new FileReader();

      // ESPERA A QUE TERMINE READASDATAURL,PARA APLICARLE EL RESULTADO EN STRING A USERDATA
      reader.onload = () => {
        this.info.imagen4 = reader.result as string;
        this.nuevaFoto4 = true;
        this.permitirPost();
      };
      reader.readAsDataURL(file);
    } else {
      this.info.imagen4 = this.infoBackUp.imagen4;
      this.nuevaFoto4 = false;
      this.permitirPost();
    }
  }

  permitirPost() {
    if (
      this.tituloValido &&
      this.precioValido &&
      this.capacidadValido &&
      this.habitacionesValido &&
      this.baniosValido &&
      this.metrosValido &&
      this.descValido &&
      this.universidadValido &&
      this.direccionValido
    ) {
      this.permitirBtnPost = true;
    } else {
      this.permitirBtnPost = false;
    }
  }

  guardarCambios() {
    this.loading = true;
    this.inmService.updateInmueble(this.info).subscribe({
      next: (respuesta) => {
        this.loadInmueble();

        this.isEditing = false;
        this.loading = false;
      },
      error: (err) => {
        console.error('Detalle del error:', err.error);
        this.loading = false;
        alert('Error: ' + (err.error.messages?.error || 'No se pudo actualizar'));
      },
    });
  }
}
