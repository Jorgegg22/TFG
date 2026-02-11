import { Component } from '@angular/core';
import { AuthService } from '../../services/auth';
import { Router } from '@angular/router';
import { MatProgressBarModule } from '@angular/material/progress-bar';

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
  value:number = 0
  emailNoValido!: boolean;
  estadoContraseña!:string;


  todoComprobado: boolean = false;
  falloRegistro: [] = [];

  constructor(
    private authService: AuthService,
    private router: Router,
  ) {}

  comprobacionEmail() {
    //Comprobaciones datos
    const emailRegex: RegExp = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (emailRegex.test(this.userData.email.toLowerCase())) {
      console.log('El correo es válido');
      this.emailNoValido = false;
    } else {
      console.log('El correo no es válido');
      if (this.userData.email.length > 1) {
        this.emailNoValido = true;
      }
    }
  }

  comprobacionPassword() {
    const regexNormal:RegExp = /^[A-Za-z\d]{8,}$/;
    const regexMedio:RegExp = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/;
    const regexFuerte:RegExp = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{12,}$/

    if(regexNormal.test(this.userData.password)){
      this.value = 33;
      this.estadoContraseña = "Flojo"
    }else if(regexMedio.test(this.userData.password)){
      this.value = 66;
      this.estadoContraseña = "Medio"
    }else if(regexFuerte.test(this.userData.password)){
      this.value = 100;
      this.estadoContraseña = "Fuerte"
    }
  }

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
