import 'package:evestors/activities/preferences/LocalPrefrences.dart';

class StartUpDao {
  int id;
  String name;
  String description;
  StartUpDao(this.id, this.name, this.description);

  // Getters
  int get getId => id;
  String get getName => name;
  String get getDescription => description;

  // Setters

  static StartUpDao getByJson(Map<String, dynamic> json) {
    return StartUpDao(json["id"], json["name"], json["description"]);
  }

  static List<StartUpDao> getByJsonList(List<dynamic> recivedList) {
    List<StartUpDao> newList = [];
    print("recived list: " + recivedList.toString());
    recivedList.forEach((element) {
      print(element["name"]);
      newList.add(getByJson(element));
    });
    return newList;
  }
}
