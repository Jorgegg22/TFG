export interface InmuebleDetalle {
    id: string;
    titulo: string;
    descripcion: string;
    direccion: string;
    precio: string;
    imagen_principal: null | string;
    propietario_id: string;
    created_at: string;
    universidad_id: string;
    nombre_propietario: string;
    nombre_universidad: string;
    solicitudes: Solicitud[];
    matches: Match[];
}

export interface Solicitud {
    id: string;
    estudiante_id: string;
    inmueble_id: string;
    estado: string;
    mensaje_presentacion: string;
    fecha_solicitud: string;
    fecha_respuesta: null | string;
    nombre_solicitante: string;
}

export interface Match {
    id: string;
    estudiante_id: string;
    inmueble_id: string;
    created_at: string;
    nombre_estudiante: string;  
}