import { Component, OnInit } from '@angular/core';
import { AuthService } from '../../services/auth';
import { Router } from '@angular/router';
import { UsuarioService } from '../../services/usuarios-service';
import { UsuarioPerfil, InfoPerfil } from '../../common/usuarioPerfil-interface';
import { Perfil } from '../usuarios/perfil/perfil';
import { trigger, state, style, transition, animate } from '@angular/animations';
import { Notificacion } from '../../common/notificacion-interface';

@Component({
  selector: 'app-header',
  standalone: false,
  templateUrl: './header.html',
  styleUrl: './header.css',
  animations: [
    trigger('enterLogut', [
      transition(':enter', [
        style({ opacity: 0, transform: 'translateY(-50%, 20px)' }),

        animate('0.3s 0.2s ease-out', style({ opacity: 1, transform: 'translateY(50%, 0)' })),
      ]),

      transition(':leave', [
        animate('0.3s ease-out', style({ opacity: 0, transform: 'translate(-50%, -20px)' })),
      ]),
    ]),
    trigger('enterInfo', [
      transition(':enter', [
        style({ opacity: 0, transform: 'translateY(-20px)' }),
        animate('0.5s 0.2s ease-out', style({ opacity: 1, transform: 'translateY(0)' })),
      ]),
    ]),
    trigger('panelAnimation', [
      transition(':enter', [
        style({
          opacity: 0,
          transform: 'scale(0.85) translateY(-10px)',
          transformOrigin: 'top right',
        }),
        animate(
          '0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275)',
          style({
            opacity: 1,
            transform: 'scale(1) translateY(0)',
          }),
        ),
      ]),
      transition(':leave', [
        animate(
          '0.2s ease-in',
          style({
            opacity: 0,
            transform: 'scale(0.95)',
            transformOrigin: 'top right',
          }),
        ),
      ]),
    ]),
  ],
})
export class Header implements OnInit {
  userId!: string | null;
  options: boolean = false;
  info!: InfoPerfil;
  perfil!: UsuarioPerfil;
  urlImagenes: string = 'https://jorgegomez.com.es/univibe/backend/public/uploads/perfiles/';
  //urlImagenes = 'http://localhost:8080/uploads/perfiles/';
  showNotifs: boolean = false;
  notificaciones: Notificacion[] = [];
  numeroNotificaciones!: number;
  menuMovil: boolean = false;

  constructor(
    private authService: AuthService,
    private userService: UsuarioService,
    private router: Router,
  ) {}

  ngOnInit(): void {
    this.loadPerfil();
  }

  loadPerfil() {
    this.userService.getPerfilUsuario().subscribe({
      next: (respuesta) => {
        console.log(respuesta);
        this.info = respuesta;
        this.perfil = this.info.data.perfil;
        if (this.perfil.foto_perfil === 'avatar_default.png') {
          this.urlImagenes = './assets/img/';
        }
        if (this.perfil && this.perfil.id) {
          this.loadNotificaciones();
        }
      },
    });
  }

  showOptions() {
    this.options = !this.options;
  }

  logout() {
    localStorage.removeItem('sesion');

    this.authService.logout().subscribe({
      complete: () => {

        window.location.href = 'https://jorgegomez.com.es/univibe/';
      },
      error: () => {
 
        window.location.href = 'https://jorgegomez.com.es/univibe/';
      },
    });
  }

  toggleNotifs() {
    this.showNotifs = !this.showNotifs;
  }

  loadNotificaciones() {
    const data = {
      id: this.perfil.id,
    };

    this.userService.getNotifiaciones(data).subscribe({
      next: (respuesta) => {
        this.notificaciones = respuesta;
        console.log('Notificaciones cargadas:', this.notificaciones);
        this.numeroNotificaciones = this.notificaciones.length;
      },
    });
  }

  toggleMovil() {
    this.menuMovil = !this.menuMovil;
  }

  closeMovilMenu() {
    this.menuMovil = false;
  }
}
