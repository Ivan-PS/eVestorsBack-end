import 'package:evestors/activities/preferences/LocalPrefrences.dart';

import '../WebService/WebService.dart';

class FolderBean {
  int id;
  String name;
  String description;
  String path;
  int parent;
  FolderBean(
    this.id,
    this.name,
    this.description,
    this.path,
    this.parent,
  );

  // Getters
  int get getId => id;
  String get getName => name;
  String get getDescription => description;
  String get getPath => path;
  int get getParent => parent;

  // Setters
  set setId(int id) => this.id = id;
  set setName(String name) => this.name = name;
  set setDescription(String description) => this.description = description;
  set setPath(String path) => this.path = path;
  set setParent(int parent) => this.parent = parent;

  static createFolder(String name, String description, String path, int parent,
      int startUpId) async {
    int idUser = await LocalPreferences().getUserId();
    return WebService()
        .createFolder(idUser, name, description, path, parent, startUpId);
  }

  static getFoldersAllowed(int idUser, int parent, int startUpId) async {
    return await WebService().getFoldersAllowed(idUser, parent, startUpId);
  }
}
