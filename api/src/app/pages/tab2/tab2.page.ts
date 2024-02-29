import { Component } from '@angular/core';
import { ApiService } from 'src/app/services/api.service';
import { TopLevel } from 'src/app/interfaces'; // Importar la clase TopLevel desde index.ts

@Component({
  selector: 'app-tab2',
  templateUrl: 'tab2.page.html',
  styleUrls: ['tab2.page.scss']
})
export class Tab2Page {
    articulo?:        string;
    imagen?:          string;
    descripcion?:     string;

  constructor(private apiService: ApiService) {}

  enviarDatos() {
    const datos: TopLevel = {
      id_articulo: -1,
      articulo: this.articulo,
      imagen: this.imagen,
      descripcion: this.descripcion,
    };

    this.apiService.postDatos(datos).subscribe(resp => {
      console.log(resp);
    });
  }
}

