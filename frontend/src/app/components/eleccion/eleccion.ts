import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from '../../services/auth';
import { trigger, state, style, transition, animate } from '@angular/animations';

@Component({
  selector: 'app-eleccion',
  standalone: false,
  templateUrl: './eleccion.html',
  styleUrl: './eleccion.css',
  animations: [
    trigger('enterRight', [
      transition(':enter', [
        style({ opacity: 0, transform: 'translateX(120px)' }),
        animate('0.8s 0.2s ease-out', style({ opacity: 1, transform: 'translateY(0)' })),
      ]),
    ]),
    trigger('enterLeft', [
      transition(':enter', [
        style({ opacity: 0, transform: 'translateX(-120px)' }),
        animate('0.8s 0.2s ease-out', style({ opacity: 1, transform: 'translateY(0)' })),
      ]),
    ]),
  ],
})
export class Eleccion {
  data: { rol: string } = {
    rol: '',
  };
  isStudent: boolean = false;
  isOwner: boolean = false;
  rol!: string;

  constructor(
    private authService: AuthService,
    private router: Router,
  ) {}

  insertRol() {
    if (this.isStudent) {
      this.rol = 'estudiante';
    }

    if (this.isOwner) {
      this.rol = 'propietario';
    }

    this.data.rol = this.rol;

    this.authService.chooseRol(this.data).subscribe({
      next: (respuesta) => {
        console.log(respuesta);
        const sesionString = localStorage.getItem('sesion');
        if (sesionString) {
          // PASAMOS A TEXT
          const sesionObj = JSON.parse(sesionString);

          // INSERTAMOS ROL
          sesionObj.rol = respuesta.rol;
         
          localStorage.setItem('sesion', JSON.stringify(sesionObj));
        }

        if (respuesta.rol === 'estudiante') {
          this.router.navigate(['/atributos']);
        } else {
          this.router.navigate(['/registro-perfil']);
        }
      },
    });
  }

  studenBtn() {
    this.isStudent = !this.isStudent;
    this.insertRol();
  }
  ownerBtn() {
    this.isOwner = !this.isOwner;
    this.insertRol();
  }
}
