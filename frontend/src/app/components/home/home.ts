import { Component , OnInit } from '@angular/core';
import { UsuarioC } from '../../services/usuarios';

export interface Usuario {
  id?: number;
  nombre?: string;
  email?: string;
  // add other properties as needed
}

@Component({
  selector: 'app-home',
  standalone: false,
  templateUrl: './home.html',
  styleUrl: './home.css'
})
export class Home {
  public alumnos: Usuario[] = [];

  constructor(private usuarioService: UsuarioC) {}

  ngOnInit(): void {
    this.obtenerAlumnos();
  }

  obtenerAlumnos(): void {
    this.usuarioService.getUsuarios().subscribe({
      next: (res) => {
        this.alumnos = Array.isArray(res) ? res : [res];
      },
      error: (err) => {
        console.error('Error al conectar con la API de UniVibe', err);
      }
    });
  }

}
