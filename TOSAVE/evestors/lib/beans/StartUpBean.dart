import 'package:evestors/activities/preferences/LocalPrefrences.dart';

import '../WebService/WebService.dart';

class StartUpBean {
  int id;
  String name;
  String description;
  StartUpBean(
    this.id,
    this.name,
    this.description,
  );

  // Getters
  int get getId => id;
  String get getName => name;
  String get getDescription => description;

  // Setters
  set setId(int id) => this.id = id;
  set setName(String name) => this.name = name;
  set setDescription(String description) => this.description = description;

  static createStartUp(String name, String description) async {
    int idUser = await LocalPreferences().getUserId();
    return WebService().createStartUp(idUser, name, description);
  }

  static getAllStartUpsAllowed(int idUser) async {
    return await WebService().getStartupsAllowed(idUser);
  }
}
