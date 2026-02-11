import { Component, effect } from '@angular/core';
import { AuthService } from '../../services/auth';
import { Router } from '@angular/router';
import { trigger, state, style, transition, animate } from '@angular/animations';
import { MatProgressBarModule } from '@angular/material/progress-bar';

@Component({
  selector: 'app-registro',
  standalone: false,
  templateUrl: './registro.html',
  styleUrl: './registro.css',
  animations: [
    trigger('enterInfo', [
      transition(':enter', [
        style({ opacity: 0, transform: 'translateX(-120px)' }),
        animate('0.8s 0.2s ease-out', style({ opacity: 1, transform: 'translateY(0)' })),
      ]),
      // Salida
    ]),
  ],
})
export class Registro {
  userData: { name: string; email: string; password: string; password_repeat: string } = {
    name: '',
    email: '',
    password: '',
    password_repeat: '',
  };
  value: number = 0;
  //Control validez campos
  emailNoValido!: boolean;
  passwordValido: boolean = false;
  repeatValido: boolean = false;
  nombreValido: boolean = false;
  condicionValido: boolean = false;
  condiciones: boolean = false;

  //Control inputs estados
  estadoPassword: string = '';
  estadoPasswordRepeat: number = 0;
  permitirRegistro: boolean = false;

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
    this.permitirBtnRegistro();
  }

  comprobacionPassword() {
    const regexNormal: RegExp = /^[A-Za-z\d]{6,}$/;
    const regexMedio: RegExp = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
    const regexFuerte: RegExp =
      /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{12,}$/;

    if (regexFuerte.test(this.userData.password)) {
      this.value = 100;
      this.estadoPassword = 'Fuerte';
      this.passwordValido = true;
    } else if (regexMedio.test(this.userData.password)) {
      this.value = 66;
      this.estadoPassword = 'Intermedia';
      this.passwordValido = false;
    } else if (regexNormal.test(this.userData.password)) {
      this.value = 33;
      this.estadoPassword = 'Debil';
      this.passwordValido = false;
    } else {
      this.value = 0;
      this.estadoPassword = '';
      this.passwordValido = false;
    }
    if (this.userData.password.length !== 0 && this.userData.password_repeat.length !== 0) {
      if (
        this.userData.password_repeat === this.userData.password &&
        this.userData.password_repeat.length > 0
      ) {
        this.estadoPasswordRepeat = 1; // Coinciden
        this.repeatValido = true;
      } else if (
        this.userData.password.length === 0 ||
        this.userData.password_repeat !== this.userData.password
      ) {
        this.estadoPasswordRepeat = 2; // No coinciden
        this.repeatValido = false;
      }
    } else {
      this.estadoPasswordRepeat = 0;
    }

    this.permitirBtnRegistro();
  }

  comprobacionCondiciones(valor: boolean) {
    this.condicionValido = valor;
    this.permitirBtnRegistro(); // Recuerda llamar a tu validador general
  }

  permitirBtnRegistro() {
    if (
      this.repeatValido &&
      this.passwordValido &&
      !this.emailNoValido &&
      this.userData.name.trim().length > 2 &&
      this.condicionValido
    ) {
      this.permitirRegistro = true;
    } else {
      this.permitirRegistro = false;
    }
  }

  registro() {
    if (this.permitirRegistro) {
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
}
