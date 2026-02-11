import { Component, OnInit } from '@angular/core';
import { Atributo } from '../../../common/atributos-interface';
import { AtributoService } from '../../../services/atributos-service';
import { Router } from '@angular/router';
import { ChangeDetectorRef } from '@angular/core';
import { trigger, state, style, transition, animate } from '@angular/animations';


@Component({
  selector: 'app-atributos',
  standalone: false,
  templateUrl: './atributos.html',
  styleUrls: ['./atributos.css'],
  animations: [
    trigger('popIn', [
      transition(':enter', [
        style({ opacity: 0, transform: 'scale(0.5)' }),
        animate('0.4s cubic-bezier(.8,-0.6,0.2,1.5)', style({ opacity: 1, transform: 'scale(1)' })),
      ]),
      transition(':leave', [
    style({ opacity: 1, transform: 'scale(1)' }),
    animate('0.4s ease-in', 
      style({ opacity: 0, transform: 'scale(0.5)' })
    ),
  ]),
    ]),
  ],
})
export class Atributos implements OnInit {
  atributos: Atributo[] = [];

  data: { atributosSelected: string[] } = {
    atributosSelected: [],
  };

  textoInformativo: boolean = false;

  constructor(
    private atrService: AtributoService,
    private router: Router,
    private cdr: ChangeDetectorRef,
  ) {}

  ngOnInit(): void {
    const sesion = localStorage.getItem('sesion');
    if (!sesion) {
      this.router.navigate(['/login']);
    } else {
      this.loadAtributos();
    }
  }

  loadAtributos() {
    this.atrService.getAtributos().subscribe({
      next: (respuesta) => {
        this.atributos = respuesta;
        console.log(this.atributos);
      },
      error: (err) => console.error('Error', err),
    });
  }

  sendAtributos() {
    this.atrService.sendAtributos(this.data).subscribe({
      next: (respuesta) => {
        this.router.navigate(['/registro-perfil']);
      },
      error: (err) => console.error('Error', err),
    });
  }

  chooseAttr(event: Event, id: string) {
    let artSelected = (event.target as HTMLInputElement).checked;
    if (artSelected) {
      this.data.atributosSelected.push(id);
    } else {
      this.data.atributosSelected = this.data.atributosSelected.filter((idItem) => idItem !== id);
    }

    console.log(this.data.atributosSelected);
  }

  mostrarInfo() {
    this.textoInformativo = !this.textoInformativo;
  }
}
