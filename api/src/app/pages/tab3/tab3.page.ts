import { Component, OnInit } from '@angular/core';
import { ApiService } from 'src/app/services/api.service';
import { TopLevel } from '../../interfaces/index';
import { ModalController } from '@ionic/angular';
import { NavController } from '@ionic/angular';

import { AppComponent } from 'src/app/app.component';
import { AngularFireAuth } from '@angular/fire/compat/auth';



@Component({
  selector: 'app-tab3',
  templateUrl: 'tab3.page.html',
  styleUrls: ['tab3.page.scss'],
  providers: [ApiService],
})
export class Tab3Page implements OnInit {
  public resp: TopLevel[] = [];
  correoSesion: String | null = null;

  constructor(private newService: ApiService, public modalController: ModalController, public appComponent: AppComponent, private afAuth : AngularFireAuth,  private navCtrl : NavController,) {

    this.afAuth.authState.subscribe(user => {
      if (user) {
        this.correoSesion = user.email;
        // Comparar el correo de sesión con el correo estático del administrador
        if (this.correoSesion === this.appComponent.correoAdmin) {
          console.log('El usuario es el administrador.');
          // Mostrar opciones para el administrador
        } else {
          console.log('El usuario NO es el administrador.');
          // Mostrar opciones para usuarios normales
        }
      }
    });

  }

  ngOnInit() {
    this.newService.getTopHeadlines().subscribe(resp => {
      console.log(resp); // Imprime el objeto TopLevel o arreglo TopLevel en la consola
      if (Array.isArray(resp)) {
        this.resp = resp; // Si es un arreglo, asigna directamente
      } else {
        this.resp = [resp]; // Si es un objeto, envuélvelo en un arreglo antes de asignar
      }
    });
  }

  deleteItem(id_articulo: number) {
    console.log('Enviando solicitud DELETE para el artículo con ID:', id_articulo);

    this.newService.deleteDato(id_articulo).subscribe(
      () => {
        console.log('Solicitud DELETE completada con éxito');
        // Puedes agregar aquí cualquier lógica adicional después de la eliminación
      },
      (error) => {
        console.error('Error al enviar solicitud DELETE:', error);
        // Manejar el error adecuadamente, por ejemplo, mostrando un mensaje al usuario
      }
    );
  }

  openAddModal() {
    this.navCtrl.navigateForward('/addmodal');
  }

  openModal(){
    this.navCtrl.navigateForward('/updatemodal')
  }

}
