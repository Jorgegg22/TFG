import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from '../../services/auth';

@Component({
  selector: 'app-eleccion',
  standalone: false,
  templateUrl: './eleccion.html',
  styleUrl: './eleccion.css',
})
export class Eleccion {
  data: { rol: string } = {
    rol: '',
  };
  isStudent: boolean = false;
  isOwner: boolean = false;
  rol!: string;
  id!: string;

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
        if (respuesta.rol === 'estudiante') {
          this.router.navigate(['/atributos']);
        } else {
          this.router.navigate(['/home-propietario']);
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
