import { ComponentFixture, TestBed } from '@angular/core/testing';

import { VistaInmueblePropietario } from './vista-inmueble-propietario';

describe('VistaInmueblePropietario', () => {
  let component: VistaInmueblePropietario;
  let fixture: ComponentFixture<VistaInmueblePropietario>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [VistaInmueblePropietario]
    })
    .compileComponents();

    fixture = TestBed.createComponent(VistaInmueblePropietario);
    component = fixture.componentInstance;
    await fixture.whenStable();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
