import 'package:evestors/activities/preferences/LocalPrefrences.dart';

class UserDao {
  int id;
  String name;
  String email;
  String firstName;
  String secondName;
  int type;
  String sessionToken;
  UserDao(this.id, this.name, this.email, this.firstName, this.secondName,
      this.type, this.sessionToken);

  // Getters
  int get getId => id;
  String get getName => name;
  String get getEmail => email;
  String get getFirstName => firstName;
  String get getSecondName => secondName;
  int get getType => type;
  String get getSessionToken => sessionToken;

  // Setters
  set setId(int id) => this.id = id;
  set setName(String name) => this.name = name;
  set setEmail(String email) => this.email = email;
  set setFirstName(String firstName) => this.firstName = firstName;
  set setSecondName(String secondName) => this.secondName = secondName;
  set setType(int type) => this.type = type;
  set setsessionToken(String sessionToken) => this.sessionToken = sessionToken;

  saveToPrefrencesUser() {
    LocalPreferences().setUserId(id);
    LocalPreferences().setUserName(name);
    LocalPreferences().setUserEmail(email);
    LocalPreferences().setUserFirstName(firstName);
    LocalPreferences().setUserSecondName(secondName);
    LocalPreferences().setUserType(type);
    LocalPreferences().setUserSessionToken(sessionToken);
  }

  static UserDao saveByJsonUser(Map<String, dynamic> json) {
    print(json);
    return UserDao(json["id"], json["name"], json["email"], json["firstName"],
        json["secondName"], json["type"], json["sessionToken"]);
  }
}
