import { Component, OnInit, NgZone } from '@angular/core';
import { UniversidadesS } from '../../services/universidades';
import { Universidad } from '../../common/universidades-interface';
import { UsuarioService } from '../../services/usuarios-service';
import { ChangeDetectorRef } from '@angular/core';

@Component({
  selector: 'app-perfil-registro',
  standalone: false,
  templateUrl: './perfil-registro.html',
  styleUrl: './perfil-registro.css',
})
export class PerfilRegistro implements OnInit {
  unis: Universidad[] = [];
  userId!: string | null;
  userName!: string;
  userEmail!: string;
  userPhone: any;
  userCareer: any;
  userDescription: any;

  constructor(
    private uniService: UniversidadesS,
    private userService: UsuarioService,
    private cdr: ChangeDetectorRef,
    private ngZone: NgZone,
  ) {}

  ngOnInit(): void {
    this.userId = localStorage.getItem('usuarioId');
    this.getDatos();

    this.loadUniversidades();
  }

  loadUniversidades() {
    this.uniService.getUniversidades().subscribe({
      next: (respuesta) => {
        console.log(respuesta);
        this.unis = respuesta
      },
      error: (err) => {
        console.error(err);
      },
    });
  }

  getDatos() {
    this.userService.getUsuarioById(this.userId).subscribe({
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
}
