import 'package:evestors/activities/preferences/LocalPrefrences.dart';
import 'package:evestors/beans/UserBean.dart';

import '../WebService/WebService.dart';
/*
class InversorBean {
  int id;
  int startup_id;
  int user_id;
  InversorBean(
    this.id,
    this.startup_id,
    this.user_id,
  );

  // Getters
  int get getId => id;
  int get getStartupId => startup_id;
  int get getUserId => user_id;

  static createInversor(int startup_id, accessCode) async {
    int idUser = await LocalPreferences().getUserId();
    return WebService().createStartUp(idUser, startup_id, accessCode);
  }

  static getAllStartUpsAllowed(int idUser) async {
    return await WebService().getStartupsAllowed(idUser);
  }
}*/
