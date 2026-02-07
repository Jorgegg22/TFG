import { Component, OnInit, NgZone } from '@angular/core';
import { UniversidadService } from '../../services/universidades';
import { Universidad } from '../../common/universidades-interface';
import { Carrera } from '../../common/carreras-interface';
import { UsuarioService } from '../../services/usuarios-service';
import { ChangeDetectorRef } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-perfil-registro',
  standalone: false,
  templateUrl: './perfil-registro.html',
  styleUrl: './perfil-registro.css',
})
export class PerfilRegistro implements OnInit {
  unis: Universidad[] = [];
  carreras: Carrera[] = [];
  userIdLocal!: string | null;
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
    private cdr: ChangeDetectorRef,
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
        this.userName = respuesta.data.nombre;
        this.userEmail = respuesta.data.email;
        console.log(this.userName + this.userEmail);

        console.log('¿Estoy en la Zona de Angular?', NgZone.isInAngularZone());
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
