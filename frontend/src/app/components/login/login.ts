import { Component, OnInit } from '@angular/core';
import { AuthService } from '../../services/auth';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  standalone: false,
  templateUrl: './login.html',
  styleUrl: './login.css',
})
export class Login implements OnInit {
  userData: { email: string; password: string } = {
    email: '',
    password: '',
  };

  sessionData!: { nombre: string; token: string };
  permitirIniciarSesion: boolean = false

  constructor(
    private authService: AuthService,
    private router: Router,
  ) {}

  ngOnInit(): void {
    localStorage.removeItem('sesion')
  }


  permitirBtnIniciarSesion(){
    const emailRegex: RegExp = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if(this.userData.password.length !== 0 && emailRegex.test(this.userData.email)){
      this.permitirIniciarSesion = true;
    }else{
      this.permitirIniciarSesion = false;
    }
  }


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
          window.location.href = `http://localhost/univibe/backend/public/admin/index?tkn=${respuesta.token} `;
          //window.location.href = `http://localhost:8080/admin/index?tkn=${respuesta.token}`; //DOCKER
        }
      },
    });
  }
}
