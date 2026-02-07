import { Component } from '@angular/core';
import { AuthService } from '../../services/auth';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  standalone: false,
  templateUrl: './login.html',
  styleUrl: './login.css',
})
export class Login {
  userData: { email: string; password: string } = {
    email: '',
    password: '',
  };

  sessionData!: { nombre: string; token: string };

  constructor(
    private authService: AuthService,
    private router: Router,
  ) {}

  login() {
    this.authService.checkUser(this.userData).subscribe({
      next: (respuesta) => {
        console.log(respuesta);
        this.sessionData = {
          nombre: respuesta.nombre,
          token: respuesta.token,
        };
        localStorage.setItem('sesion', JSON.stringify(this.sessionData));
        if (respuesta.rol === 'estudiante') {
          this.router.navigate(['/home-estudiante']);
        } else if (respuesta.rol === 'propietario') {
          this.router.navigate(['/home-propietario']);
        } else {
          window.location.href = 'http://localhost:8080/public/admin/';
        }
      },
    });
  }
}
