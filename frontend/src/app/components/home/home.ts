import { Component , OnInit } from '@angular/core';
import { UsuarioService } from '../../services/usuarios-service';
import { trigger, state, style, transition, animate } from '@angular/animations';

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
  styleUrl: './home.css',
  animations: [
   

    trigger('enterInfo', [
      transition(':enter', [
        style({ opacity: 0, transform: 'translateY(50px)' }), 
        animate('0.8s 0.2s ease-out', style({ opacity: 1, transform: 'translateY(0)' })), 
      ]),

    ]),
    trigger('enterText', [
      transition(':enter', [
        style({ opacity: 0, transform: 'translateX(-120px)' }), 
        animate('0.8s 0.2s ease-out', style({ opacity: 1, transform: 'translateY(0)' })), 
      ]),
      // Salida
    ]),
    
  ],
})
export class Home {
  
  alumnos: Usuario[] = [];

  constructor(private usuarioService: UsuarioService) {}

  ngOnInit(): void {
  
  }


}
