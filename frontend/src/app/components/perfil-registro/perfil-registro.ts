import { Component, OnInit, NgZone } from '@angular/core';
import { UniversidadService } from '../../services/universidades';
import { Universidad } from '../../common/universidades-interface';
import { Carrera } from '../../common/carreras-interface';
import { UsuarioService } from '../../services/usuarios-service';
import { ChangeDetectorRef } from '@angular/core';
import { Router } from '@angular/router';
import { Usuario } from '../../common/usuarios-interface';
import { Perfil } from '../usuarios/perfil/perfil';

@Component({
  selector: 'app-perfil-registro',
  standalone: false,
  templateUrl: './perfil-registro.html',
  styleUrl: './perfil-registro.css',
})
export class PerfilRegistro implements OnInit {
  unis: Universidad[] = [];
  carreras: Carrera[] = [];
  atributosString!: string
  atributosUsuario: string[] = [];
  atributosUsuarioObject: { nombre: string; icono: string }[] = [];
  userIdLocal!: string | null;
  perfil!:Usuario
  userName!: string;
  userEmail!: string;
  userData: {
    userPhone: string;
    userCareer: string;
    userDescription: string;
    userUni: string;
  } = {
    userPhone: '',
    userCareer: '',
    userDescription: '',
    userUni: '',
  };

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
        this.perfil = respuesta
        this.userName = this.perfil.data.nombre
        this.userEmail = this.perfil.data.email
       this.atributosString = this.perfil.data.atributos_usuario

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
}
