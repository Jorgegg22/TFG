import { Component, OnInit } from '@angular/core';
import { InmuebleService } from '../../services/inmuebles-service';
import { ActivatedRoute, Router } from '@angular/router';
import { InmuebleDetalle, Solicitud, Match } from '../../common/pisoDetalle-interface';
import { trigger, state, style, transition, animate } from '@angular/animations';
import { Location } from '@angular/common';
import { PropietarioService } from '../../services/propietarios-service';
@Component({
  selector: 'app-vista-piso',
  standalone: false,
  templateUrl: './vista-piso.html',
  styleUrl: './vista-piso.css',
  animations: [
    trigger('enterAnimation', [
      // Animaciones Like/Dislike
      // (* significa estado
      transition(':enter', [
        style({ opacity: 0, transform: 'scale(0.95)' }),
        animate('0.3s ease-in', style({ opacity: 1, transform: 'scale(1)' })),
      ]),
    ]),

    trigger('modalAnimation', [
      // 1. Entrada: Aparece y crece un poco (efecto Pop)
      transition(':enter', [
        style({ opacity: 0, transform: 'scale(0.8)' }), // Empieza transparente y al 80% de tamaño
        animate('300ms ease-out', style({ opacity: 1, transform: 'scale(1)' })), // Termina visible y tamaño normal
      ]),

      // 2. Salida: Desaparece y se encoge (efecto Receder)
      transition(':leave', [
        style({ opacity: 1, transform: 'scale(1)' }), // (Opcional) Estado inicial explícito
        animate('200ms ease-in', style({ opacity: 0, transform: 'scale(0.8)' })), // Se va a transparente y pequeño
      ]),
    ]),
  ],
})
export class VistaPiso implements OnInit {
  idInmueble!: string;
  info!: InmuebleDetalle;
  solicitudes: Solicitud[] = [];
  matches: Match[] = [];
  previousUrl!: string | null;
  edit: boolean = false;
  loading: boolean = true;
  sesionNombre!: string;
  sesionNombreItem!: any;
  huecosDisponibles!: number;
  imgSrc!: string;
  mostrarModal: boolean = false;
  mostrarConfirmarBorrado:boolean = false

  urlImagenes = 'http://localhost:8080/uploads/inmuebles_fotos/';
  //urlImagenes = 'http://localhost/univibe/backend/public/uploads/inmuebles_fotos/';

  ngOnInit(): void {
    this.loadInmueble();
  }

  constructor(
    private inmService: InmuebleService,
    private propService: PropietarioService,
    private activatedRoute: ActivatedRoute,
    private location: Location,
    private router:Router
  ) {}

  loadInmueble() {
    this.idInmueble = this.activatedRoute.snapshot.params['id'];
    this.inmService.getInmueble(this.idInmueble).subscribe({
      next: (respuesta) => {
        console.log('hay piso');
        this.info = respuesta;
        this.solicitudes = this.info.solicitudes;
        this.matches = this.info.matches;
        console.log(this.info);
        console.log(this.solicitudes);
        console.log(this.matches);
        console.log(this.info.nombre_propietario);
        const sesionStr = localStorage.getItem('sesion');
        const sesionObj = JSON.parse(sesionStr || '{}');
        this.sesionNombre = sesionObj.nombre;
        console.log(this.sesionNombre);

        if (this.info.nombre_propietario === this.sesionNombre) {
          this.edit = true;
        }

        console.log(this.info.n_personas);
        let numeroMatches = this.matches.length;
        console.log(numeroMatches);
        this.huecosDisponibles = parseInt(this.info.n_personas) - numeroMatches;

        this.loading = false;
      },
    });
  }

  onClickImagen(event: PointerEvent) {
    var target = event.target as any;
    var srcAttr = target.attributes.src;
    this.imgSrc = srcAttr.nodeValue;
    this.mostrarModal = true;
  }

  cerrarModal() {
    console.log('cerrando');
    this.mostrarModal = false;
  }

  volver() {
    this.location.back();
  }

  confirmar(){
    this.mostrarConfirmarBorrado = true
  }


  eliminarPiso(){
    this.propService.deleteInmueble(this.idInmueble).subscribe({
      next:(respuesta) => {
        this.router.navigate(['/inmuebles-propietario'],{
          queryParams: {eliminado:'true'}
        })
      }
    })
  }
}
