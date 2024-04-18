import { Component, OnInit } from '@angular/core';
import { ApiService } from 'src/app/services/api.service';
import { TopLevel } from 'src/app/interfaces'; // Importar la clase TopLevel desde index.ts
import { AngularFireAuth } from '@angular/fire/compat/auth';
import { AngularFirestore } from '@angular/fire/compat/firestore';
import { AlertController } from '@ionic/angular';
import { User } from '@firebase/auth-types'; 



@Component({
  selector: 'app-tab2',
  templateUrl: 'tab2.page.html',
  styleUrls: ['tab2.page.scss']
})



export class Tab2Page implements OnInit{

  userData = {
    nombre: '',
    email: '',
  };

  isAuthenticated = false;
  user: User | null = null;

  constructor(
    private afAuth: AngularFireAuth,
    private firestore: AngularFirestore,
    private alertController: AlertController
  ) {}

  ngOnInit(){
    this.afAuth.authState.subscribe((user) => {
      if (user) {
        this.isAuthenticated = true;
        this.user = user;
        this.userData.nombre = user.displayName || '';
        this.userData.email = user.email || '';
      } else {
        this.isAuthenticated = false;
        this.user = null;
      }
    });
  }

  async getUserData() {
    const user = await this.afAuth.currentUser;
    if (user) {
      this.isAuthenticated = true; // Usuario autenticado
      this.userData.nombre = user.displayName || '';
      this.userData.email = user.email || '';
    } else {
      this.isAuthenticated = false; // Usuario no autenticado
    }
  }

    async updateProfile() {
      const user = await this.afAuth.currentUser;
      if (user) {
        try {
          // Actualizar el nombre del usuario en Firebase Authentication
          await user.updateProfile({
            displayName: this.userData.nombre,
          });
          // Actualizar el documento del perfil en Firestore
          await this.firestore.collection('users').doc(user.uid).update({
            nombre: this.userData.nombre,
          });
          this.presentAlert('Perfil actualizado correctamente.');
        } catch (error) {
          this.presentAlert('Error al actualizar el perfil. Inténtalo de nuevo.');
        }
      }
    }

    async presentAlert(message: string) {
      const alert = await this.alertController.create({
        header: 'Alerta',
        message: message,
        buttons: ['OK'],
      });

      await alert.present();


    }
  }



//     articulo?:        string;
//     imagen?:          string;
//     descripcion?:     string;

//   constructor(private apiService: ApiService) {}

//   enviarDatos() {
//     const datos: TopLevel = {
//       id_articulo: -1,
//       articulo: this.articulo,
//       imagen: this.imagen,
//       descripcion: this.descripcion,
//     };

//     this.apiService.postDatos(datos).subscribe(resp => {
//       console.log(resp);
//     });
//   }
