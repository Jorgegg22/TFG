import { Component, OnInit } from '@angular/core';
import { UsuarioService } from '../../../services/usuarios-service';
import { Solicitud, Data ,Inmueble} from '../../../common/solicitudes-interface';

@Component({
  selector: 'app-solicitudes',
  standalone: false,
  templateUrl: './solicitudes.html',
  styleUrl: './solicitudes.css',
})
export class Solicitudes implements OnInit {
  userData: { userId: string | null } = {
    userId: localStorage.getItem('usuarioId'),
  };

  info!:Solicitud 
  inmuebles:Inmueble[] = [];

  ngOnInit(): void {
    this.loadSolicitudes();
  }

  constructor(private userService: UsuarioService) {}

  loadSolicitudes() {
    this.userService.getSolicitudesUsuario(this.userData).subscribe({
      next: (respuesta) => {
        console.log(respuesta);
        this.info = respuesta;
        this.inmuebles = this.info.data.inmuebles;
        console.log(this.inmuebles);

        
        
      },
      error: (err) => console.error('Error', err),
    });
  }
}
