import { Component } from '@angular/core';
import { UsuarioService } from '../../../services/usuarios-service';
import { UsuarioPerfil, InfoPerfil } from '../../../common/usuarioPerfil-interface';
import { trigger, state, style, transition, animate } from '@angular/animations';
import { AuthService } from '../../../services/auth';
import { Router } from '@angular/router';


@Component({
  selector: 'app-header-propietario',
  standalone: false,
  templateUrl: './header-propietario.html',
  styleUrl: './header-propietario.css',
  animations: [
  trigger('enterLogout', [
    // Entrada: Aparece invisible y 10px más arriba, y baja a su sitio
    transition(':enter', [
      style({ opacity: 0, transform: 'translateY(-10px)' }),
      animate('200ms ease-out', style({ opacity: 1, transform: 'translateY(0)' })),
    ]),
    
    // Salida: Se desvanece y sube un poco
    transition(':leave', [
      style({ opacity: 1, transform: 'translateY(0)' }),
      animate('200ms ease-in', style({ opacity: 0, transform: 'translateY(-10px)' })),
    ]),
  ]),
  trigger('enterInfo', [
      transition(':enter', [
        style({ opacity: 0, transform: 'translateY(-20px)' }),
        animate('0.5s 0.2s ease-out', style({ opacity: 1, transform: 'translateY(0)' })),
      ]),
      
    ]),
],
})
export class HeaderPropietario {
  userId!: string | null;
  options: boolean = false;
  info!: InfoPerfil;
  perfil!: UsuarioPerfil;
  urlImagenes: string =
    'https://jorgegomez.com.es/univibe/backend/public/uploads/perfiles/';
  //urlImagenes = 'http://localhost:8080/uploads/perfiles/';
  menuMovil:boolean = false

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
}
