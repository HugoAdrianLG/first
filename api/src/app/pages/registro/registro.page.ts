import { Component, OnInit } from '@angular/core';
import { AlertController } from '@ionic/angular';
import { AngularFireAuth } from '@angular/fire/compat/auth';
import { AngularFirestore } from '@angular/fire/compat/firestore';
import { Router } from '@angular/router';

@Component({
  selector: 'app-registro',
  templateUrl: './registro.page.html',
  styleUrls: ['./registro.page.scss'],
})
export class RegistroPage implements OnInit {

  nombre: string='';
  email: string = '';
  password: string = '';
  username: string = '';


  constructor(
    private alertController: AlertController,
    private afAuth: AngularFireAuth,
    private firestore: AngularFirestore,
    private router:Router
  ) {

  }

  ngOnInit() {
  }

  async register() {
    try {
      const userCredential = await this.afAuth.createUserWithEmailAndPassword(
        this.email,
        this.password
      );

      if (userCredential && userCredential.user) {
        // Verifica que userCredential y userCredential.user no sean null
        const user = userCredential.user;

        // Actualiza el nombre de usuario en la información de perfil
        await user.updateProfile({
          displayName: this.username,
        });

        // Crea un documento de perfil para el usuario en Firestore
        await this.firestore.collection('users').doc(user.uid).set({
          nombre: this.nombre,
          email: this.email,
          username: this.username,
          // Otros datos del perfil que desees guardar
        });

        this.presentAlert('¡Registro exitoso! Ahora puedes iniciar sesión.');
        this.router.navigateByUrl('')
      } else {
        // Maneja el caso en que userCredential o userCredential.user son null
        this.presentAlert('Error al registrar. Inténtalo de nuevo.');
      }
    } catch (error) {
      this.presentAlert('Error al registrar. Inténtalo de nuevo.');
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
