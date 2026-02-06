import { Component, OnInit } from '@angular/core';
import { InmuebleService } from '../../services/inmuebles-service';
import { ActivatedRoute } from '@angular/router';
import { InmuebleDetalle, Solicitud, Match } from '../../common/pisoDetalle-interface';
import { NavigationService } from '../../services/navigation-service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-vista-piso',
  standalone: false,
  templateUrl: './vista-piso.html',
  styleUrl: './vista-piso.css',
})
export class VistaPiso implements OnInit {
  idInmueble!: string;
  info!: InmuebleDetalle;
  solicitudes: Solicitud[] = [];
  matches: Match[] = [];
  previousUrl!:string | null;

  ngOnInit(): void {
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
      },
    });
  }
}
