import { Component } from '@angular/core';
import { AuthService } from '../../services/auth';
import { Router } from '@angular/router';

@Component({
  selector: 'app-registro',
  standalone: false,
  templateUrl: './registro.html',
  styleUrl: './registro.css',
})
export class Registro {
  userData: { name: string; email: string; password: string; password_repeat: string } = {
    name: '',
    email: '',
    password: '',
    password_repeat: '',
  };

  constructor(
    private authService: AuthService,
    private router: Router,
  ) {}

  registro() {
    this.authService.register(this.userData).subscribe({
      next: (respuesta) => {
        const sessionData = {
          nombre: respuesta.nombre,
          token: respuesta.token,
        };
        
        localStorage.setItem('sesion', JSON.stringify(sessionData));

        this.router.navigate(['/eleccion']);
      },
    });
  }
}
