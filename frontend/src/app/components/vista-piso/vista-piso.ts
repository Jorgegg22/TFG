import { Component, OnInit } from '@angular/core';
import { InmuebleService } from '../../services/inmuebles-service';
import { ActivatedRoute } from '@angular/router';
import { InmuebleDetalle, Solicitud, Match } from '../../common/pisoDetalle-interface';
import { NavigationService } from '../../services/navigation-service';
import { Router } from '@angular/router';
import { trigger, state, style, transition, animate } from '@angular/animations';
import { count } from 'rxjs';

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
  huecosDisponibles!: number;
  imgSrc!:string;
  mostrarModal:boolean = false

  //urlImagenes = 'http://localhost:8080/uploads/inmuebles_fotos/';
  urlImagenes = 'http://localhost/univibe/backend/public/uploads/inmuebles_fotos/';

  ngOnInit(): void {
    const sesionData = localStorage.getItem('sesion');
    if (sesionData) {
      const data = JSON.parse(sesionData);
      this.sesionNombre = data;
    }
    const prevPage = this.navigationService.previousUrl;

    if (prevPage !== this.router.url) {
      this.previousUrl = prevPage;
    } else {
      this.previousUrl = '/solicitudes';
    }

    console.log('Previous URL:', this.previousUrl);
    this.loadInmueble();
  }

  constructor(
    private inmService: InmuebleService,
    private activatedRoute: ActivatedRoute,
    private navigationService: NavigationService,
    private router: Router,
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

  onClickImagen(event:PointerEvent) {
;
    var target = event.target as any
    var srcAttr = target.attributes.src;
    this.imgSrc = srcAttr.nodeValue;
    this.mostrarModal = true
  }

  cerrarModal(){
    console.log("cerrando");
    this.mostrarModal = false
    
  }
}
