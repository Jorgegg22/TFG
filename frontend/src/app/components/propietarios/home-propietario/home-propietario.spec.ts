import { ComponentFixture, TestBed } from '@angular/core/testing';

import { HomePropietario } from './home-propietario';

describe('HomePropietario', () => {
  let component: HomePropietario;
  let fixture: ComponentFixture<HomePropietario>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [HomePropietario]
    })
    .compileComponents();

    fixture = TestBed.createComponent(HomePropietario);
    component = fixture.componentInstance;
    await fixture.whenStable();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
