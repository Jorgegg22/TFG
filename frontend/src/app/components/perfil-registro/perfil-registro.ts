import { Component, OnInit, NgZone } from '@angular/core';
import { UniversidadService } from '../../services/universidades';
import { Universidad } from '../../common/universidades-interface';
import { Carrera } from '../../common/carreras-interface';
import { UsuarioService } from '../../services/usuarios-service';
import { ChangeDetectorRef } from '@angular/core';
import { Router } from '@angular/router';
import { Usuario } from '../../common/usuarios-interface';
import { trigger, state, style, transition, animate } from '@angular/animations';
import { flatMap } from 'rxjs';

@Component({
  selector: 'app-perfil-registro',
  standalone: false,
  templateUrl: './perfil-registro.html',
  styleUrl: './perfil-registro.css',
  animations: [
    trigger('enterPerfil', [
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
export class PerfilRegistro implements OnInit {
  unis: Universidad[] = [];
  carreras: Carrera[] = [];
  atributosString!: string;
  atributosUsuario: string[] = [];
  atributosUsuarioObject: { nombre: string; icono: string }[] = [];
  userIdLocal!: string | null;
  perfil!: Usuario;
  userName!: string;
  userEmail!: string;
  userData: {
    userPhoto: string;
    userPhone: string;
    userCareer: string;
    userDescription: string;
    userUni: string;
    image?: any;
  } = {
    userPhoto: 'avatar_default.png',
    userPhone: '',
    userCareer: '',
    userDescription: '',
    userUni: '',
  };

  telefonoValido: boolean = false;
  carreraValido: boolean = false;
  universidadValido: boolean = false;
  descripcionValido: boolean = false;

  permitirPostDatos: boolean = false;
  selectedFile: File | null = null;

  constructor(
    private uniService: UniversidadService,
    private userService: UsuarioService,
    private router: Router,
  ) {}

  ngOnInit(): void {
    this.getDatos();
    this.loadUniversidades();
    this.loadCarreras();
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

  getDatos() {
    this.userService.getUsuarioByToken().subscribe({
      next: (respuesta) => {
        console.log(respuesta);
        this.perfil = respuesta;
        this.userName = this.perfil.data.nombre;
        this.userEmail = this.perfil.data.email;
        this.atributosString = this.perfil.data.atributos_usuario;

        this.atributosUsuarioObject = [];
        if (this.atributosString) {
          this.atributosUsuario = this.atributosString.split(';');
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
      },
      error(err) {
        console.error('Error');
      },
    });
  }

  postDatos() {
    console.log(this.userData);

    this.userService.postDatosPerfi(this.userData).subscribe({
      next: (respuesta) => {
        console.log('Va');
        console.log(respuesta);
        this.router.navigate(['/home-estudiante']);
      },
      error(err) {
        console.log('No va');

        console.error('Error');
      },
    });
  }

  nombreFoto(event: any) {
    const file = event.target.files[0];
    if (file) {
      // TRADUCTOR DE IMAGENES PARA MANDAR EL CONTENIDO DE LA IMAGEN
      const reader = new FileReader();

      // ESPERA A QUE TERMINE READASDATAURL,PARA APLICARLE EL RESULTADO EN STRING A USERDATA
      reader.onload = () => {
        this.userData.userPhoto = reader.result as string;
      };
      reader.readAsDataURL(file);
    } else {
      this.userData.userPhoto = 'avatar_default.png';
    }

    
  }

  validacionTelefono() {
    const phoneRegex: RegExp = /^[6]\d{8}$/;
    if (phoneRegex.test(this.userData.userPhone)) {
      this.telefonoValido = true;
    } else {
      this.telefonoValido = false;
    }
    this.permitirBtnPostDatos();
  }

  validacionCarrera() {
    if (this.userData.userCareer !== '') {
      this.carreraValido = true;
    } else {
      this.carreraValido = false;
    }
    this.permitirBtnPostDatos();
  }

  validacionDescripcion() {
    const longitudDescripcion = this.userData.userDescription.trim().length;
    if (longitudDescripcion >= 10 && longitudDescripcion < 200) {
      this.descripcionValido = true;
    } else {
      this.descripcionValido = false;
    }
    this.permitirBtnPostDatos();
  }

  validacionUniversidad() {
    if (this.userData.userUni !== '') {
      this.universidadValido = true;
    } else {
      this.universidadValido = false;
    }

    this.permitirBtnPostDatos();
  }

  permitirBtnPostDatos() {
    if (
      this.universidadValido &&
      this.descripcionValido &&
      this.carreraValido &&
      this.telefonoValido
    ) {
      this.permitirPostDatos = true;
    } else {
      this.permitirPostDatos = false;
    }
  }
}
