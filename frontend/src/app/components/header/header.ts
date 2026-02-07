import { Component, OnInit } from '@angular/core';
import { AuthService } from '../../services/auth';
import { Router } from '@angular/router';

@Component({
  selector: 'app-header',
  standalone: false,
  templateUrl: './header.html',
  styleUrl: './header.css',
})
export class Header implements OnInit {
  userId!: string | null;
  options: boolean = false;

   constructor(private authService:AuthService,
    private router:Router
   ){}

  ngOnInit(): void {
    /* const datosSesion = localStorage.getItem('sesion');

    if (datosSesion) {
      const sesionObj = JSON.parse(datosSesion);
      this.userId = sesionObj.id;
    } */
  }

  showOptions() {
    this.options = !this.options;
  };

  logout(){
    this.authService.logout().subscribe({
      next:(respuesta) => {
        localStorage.removeItem('sesion');
        this.router.navigate(['/login']);
      }
    })
  };



}
