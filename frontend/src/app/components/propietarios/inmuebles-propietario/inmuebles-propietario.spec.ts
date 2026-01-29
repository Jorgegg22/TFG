import { ComponentFixture, TestBed } from '@angular/core/testing';

import { InmueblesPropietario } from './inmuebles-propietario';

describe('InmueblesPropietario', () => {
  let component: InmueblesPropietario;
  let fixture: ComponentFixture<InmueblesPropietario>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [InmueblesPropietario]
    })
    .compileComponents();

    fixture = TestBed.createComponent(InmueblesPropietario);
    component = fixture.componentInstance;
    await fixture.whenStable();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
