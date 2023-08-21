import 'package:evestors/activities/preferences/LocalPrefrences.dart';

class FolderDao {
  int id;
  String name;
  String description;
  int parent_id;
  FolderDao(this.id, this.name, this.description, this.parent_id);

  // Getters
  int get getId => id;
  String get getName => name;
  String get getDescription => description;
  int get getParentId => parent_id;

  // Setters

  static FolderDao getByJson(Map<String, dynamic> json) {
    return FolderDao(
        json["id"], json["name"], json["description"], json["parent"]);
  }

  static List<FolderDao> getByJsonList(List<dynamic> recivedList) {
    List<FolderDao> newList = [];
    print("recived list: " + recivedList.toString());
    recivedList.forEach((element) {
      print(element["name"]);
      newList.add(getByJson(element));
    });
    return newList;
  }
}
