export interface SolicitudesPropietarioResponse {
  status: string;
  mensaje: string;
  data: DataSolicitudesPropietario;
}

// -------------------------

export interface DataSolicitudesPropietario {
  inmuebles: InmueblesSolicitudes;
}

// -------------------------

export interface InmueblesSolicitudes {
  solicitudes: SolicitudesHoy[];
  total_solicitudes: number;
}

// -------------------------

export interface SolicitudesHoy {
  solicitud_id: string;
  fecha_solicitud: string;

  inmueble_id: string;
  titulo: string;
  precio: string;
  direccion: string;
  imagen_principal: string;

  estudiante_id: string;
  nombre_estudiante: string;
  email: string;
  telefono: string;
}
