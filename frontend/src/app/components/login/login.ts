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

  sessionData!: {id:string;nombre: string;email:string,rol:string}

  constructor(
    private authService: AuthService,
    private router: Router,
  ) {}

  login() {
    this.authService.checkUser(this.userData).subscribe({
      next: (respuesta) => {
        console.log(respuesta);
        this.sessionData = {
        id: respuesta.id,
        nombre: respuesta.nombre,
        email: respuesta.email,
        rol: respuesta.rol
      };
        localStorage.setItem('sesion',JSON.stringify(this.sessionData));
        if (respuesta.rol === 'estudiante') {
          
          this.router.navigate(['/home-estudiante']);
        } else {
          this.router.navigate(['/home-propietario']);
        }
      },
    });
  }
}
