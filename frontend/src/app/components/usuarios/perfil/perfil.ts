import { Component, OnInit } from '@angular/core';
import { UsuarioPerfil, InfoPerfil } from '../../../common/usuarioPerfil-interface';
import { UsuarioService } from '../../../services/usuarios-service';
import { ActivatedRoute } from '@angular/router';
import { Router } from '@angular/router';
import { trigger, state, style, transition, animate } from '@angular/animations';
import { Location } from '@angular/common';
import { PropietarioService } from '../../../services/propietarios-service';
import { ListaInmuebles } from '../../../common/inmuebles-interface';
import { UniversidadService } from '../../../services/universidades';
import { Carrera } from '../../../common/carreras-interface';
import { Universidad } from '../../../common/universidades-interface';

@Component({
  selector: 'app-perfil',
  standalone: false,
  templateUrl: './perfil.html',
  styleUrl: './perfil.css',
  animations: [
    trigger('enterAnimation', [
      // (* significa estado
      transition(':enter', [
        style({ opacity: 0, transform: 'scale(0.95)' }),
        animate('0.3s ease-in', style({ opacity: 1, transform: 'scale(1)' })),
      ]),
    ]),
    trigger('enterSideBar', [
      transition(':enter', [
        style({ opacity: 0, transform: 'translateX(100%)' }),
        animate('0.3s 0.2s ease-out', style({ opacity: 1, transform: 'translateX(0)' })),
      ]),
    ]),
  ],
})
export class Perfil implements OnInit {
  unis: Universidad[] = [];
  carreras: Carrera[] = [];
  id!: string;
  isEditing: boolean = false;
  perfilPropio: boolean = false;
  info!: InfoPerfil;
  perfil!: UsuarioPerfil;
  perfilBackUp!: UsuarioPerfil;
  previousUrl!: string | null;
  atributosUsuario: string[] = [];
  atributosUsuarioAll: [] = [];
  atributosUsuarioObject: { nombre: string; icono: string }[] = [];
  loading: boolean = true;
  estudiante!: boolean;
  allInmuebles: ListaInmuebles = [];
  inmuebles: ListaInmuebles = [];
  infoInmuebles: boolean = false;
  urlImagenesInmuebles = 'http://localhost:8080/uploads/inmuebles_fotos/';
  urlImagenesPerfil = 'http://localhost:8080/uploads/perfiles/';
  telefonoValido: boolean = true;
  carreraValido: boolean = true;
  universidadValido: boolean = true;
  descripcionValido: boolean = true;
  emailValido: boolean = true;

  permitirPostDatos: boolean = false;
  nuevoEmail: boolean = false;
  nuevoTelefono: boolean = false;
  nuevaFoto: boolean = false;

  constructor(
    private userService: UsuarioService,
    private activatedRoute: ActivatedRoute,
    private location: Location,
    private propService: PropietarioService,
    private uniService: UniversidadService,
  ) {}

  ngOnInit(): void {
    this.id = this.activatedRoute.snapshot.params['id'];
    if (this.id) {
      this.perfilPropio = false;
    } else {
      // SI NO HAY ID EN URL PERFIL PROPIO
      this.perfilPropio = true;
    }
    this.loadPerfil();
  }

  loadPerfil() {
    this.userService.getPerfilUsuario(this.id).subscribe({
      next: (respuesta) => {
        console.log(respuesta);

        this.info = respuesta;
        this.perfil = this.info.data.perfil;
        this.perfilBackUp = { ...respuesta.data.perfil };

        if (this.perfil.rol === 'estudiante') {
          this.estudiante = true;
          this.atributosUsuarioObject = [];
          if (this.perfil.atributos_usuario) {
            this.atributosUsuario = this.perfil.atributos_usuario.split(';');
            this.atributosUsuario.forEach((element) => {
              const partes = element.split('|');
              if (partes.length === 2) {
                this.atributosUsuarioObject.push({
                  nombre: partes[0],
                  icono: partes[1],
                });
              }
            });
          }
          this.loadCarreras();
          this.loadUniversidades();
        } else if (this.perfil.rol === 'propietario') {
          const idPropietario = this.perfil.id;
          console.log('es propietario');
          this.estudiante = false;
          this.loadInmuebles(idPropietario);
        }

        this.loading = false;
      },
      error: (err) => console.error('Error al cargar perfil', err),
    });
  }

  loadInmuebles(idPropietario: string) {
    this.propService.getInmueblesPropietario(idPropietario).subscribe({
      next: (respuesta: any) => {
        console.log(respuesta);
        this.allInmuebles = respuesta;
        if (this.allInmuebles.length === 0) {
          this.infoInmuebles = false;
        } else {
          this.infoInmuebles = true;

          console.log(this.allInmuebles.length);
        }
      },
    });
  }

  guardarCambios() {
    this.loading = true;

    this.userService.updatePerfil(this.perfil).subscribe({
      next: (response) => {
        console.log('Perfil actualizado', response);
        this.loadPerfil();
        this.isEditing = false;
        this.nuevaFoto = false;
      },
      error: (err) => {
        console.error('Error al guardar', err);

        this.perfil = { ...this.perfilBackUp };
        this.loading = false;
      },
    });
  }

  toggleEdit() {
    if (this.isEditing) {
      //RESETEAMOS DATOS DE EDITAR
      this.perfil = { ...this.perfilBackUp };

      this.nuevoEmail = false;
      this.nuevoTelefono = false;
    }

    this.isEditing = !this.isEditing;
  }

  volver() {
    this.location.back();
  }

  loadCarreras() {
    this.uniService.getCarreras().subscribe({
      next: (respuesta) => {
        console.log(respuesta);
        this.carreras = respuesta;
      },
      error: (err) => {
        console.error(err);
      },
    });
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

  nombreFoto(event: any) {
    const file = event.target.files[0];
    if (file) {
      // TRADUCTOR DE IMAGENES PARA MANDAR EL CONTENIDO DE LA IMAGEN
      const reader = new FileReader();

      // ESPERA A QUE TERMINE READASDATAURL,PARA APLICARLE EL RESULTADO EN STRING A PERFIL
      reader.onload = () => {
        this.perfil.foto_perfil = reader.result as string;
        this.nuevaFoto = true;
        this.permitirBtnPostDatos();
      };
      reader.readAsDataURL(file);
    } else {
      this.perfil.foto_perfil = this.perfilBackUp.foto_perfil;
      this.nuevaFoto = false;
      this.permitirBtnPostDatos();
    }
  }

  validacionCarrera() {
    if (this.perfil.id_carrera !== '' && this.perfil.id_carrera !== this.perfilBackUp.id_carrera) {
      this.carreraValido = true;
    } else {
      this.carreraValido = false;
    }
    this.permitirBtnPostDatos();
  }

  validacionDescripcion() {
    const longitudDescripcion = this.perfil.descripcion.trim().length;
    if (
      longitudDescripcion >= 10 &&
      longitudDescripcion < 200 &&
      this.perfil.descripcion !== this.perfilBackUp.descripcion
    ) {
      this.descripcionValido = true;
    } else {
      this.descripcionValido = false;
    }
    this.permitirBtnPostDatos();
  }

  validacionUniversidad() {
    if (
      this.perfil.universidad_id !== '' &&
      this.perfil.universidad_id !== this.perfilBackUp.universidad_id
    ) {
      this.universidadValido = true;
    } else {
      this.universidadValido = false;
    }

    this.permitirBtnPostDatos();
  }

  validacionEmail() {
    this.nuevoEmail = true;
    const emailRegex: RegExp = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    const valor = this.perfil.email ? this.perfil.email.trim() : '';
    if (
      emailRegex.test(valor.toLocaleLowerCase()) &&
      this.perfil.email !== this.perfilBackUp.email
    ) {
      this.emailValido = true;
    } else {
      this.emailValido = false;
    }
    this.permitirBtnPostDatos();
  }

  validacionTelefono() {
    this.nuevoTelefono = true;
    const phoneRegex: RegExp = /^[6]\d{8}$/;
    const valor = this.perfil.telefono ? this.perfil.telefono.trim() : '';
    if (phoneRegex.test(valor) && valor !== this.perfilBackUp.telefono.trim()) {
      this.telefonoValido = true;
    } else {
      this.telefonoValido = false;
    }
    this.permitirBtnPostDatos();
  }

  permitirBtnPostDatos() {
    if (this.estudiante) {
      this.permitirPostDatos =
        this.universidadValido &&
        this.descripcionValido &&
        this.carreraValido &&
        this.telefonoValido;
    } else if (!this.estudiante) {
      this.permitirPostDatos = this.telefonoValido && this.descripcionValido && this.emailValido;
    }
  }

  validarDatosIniciales() {
    this.validacionEmail();
    this.validacionTelefono();
    this.validacionDescripcion();

    this.nuevoEmail = false;
    this.nuevoTelefono = false;

    if (this.estudiante) {
      this.validacionCarrera();
      this.validacionUniversidad();
    }
  }
}
