import 'package:evestors/Utils/ResponseDecoder.dart';

import '../WebService/WebService.dart';

class UserBean {
  int id;
  String name;
  String email;
  String password;
  String firstName;
  String secondName;
  int type;
  String sessionToken;
  UserBean(this.id, this.name, this.email, this.password, this.firstName,
      this.secondName, this.type, this.sessionToken);

  // Getters
  int get getId => id;
  String get getName => name;
  String get getEmail => email;
  String get getPassword => password;
  String get getFirstName => firstName;
  String get getSecondName => secondName;
  int get getType => type;
  String get getSessionToken => sessionToken;

  // Setters
  set setId(int id) => this.id = id;
  set setName(String name) => this.name = name;
  set setEmail(String email) => this.email = email;
  set setPassword(String password) => this.password = password;
  set setFirstName(String firstName) => this.firstName = firstName;
  set setSecondName(String secondName) => this.secondName = secondName;
  set setType(int type) => this.type = type;
  set setsessionToken(String sessionToken) => this.sessionToken = sessionToken;

  static registerUser(String name, String email, String password,
      String firstName, String secondName, int type) {
    return WebService()
        .createUser(name, password, email, firstName, secondName, type);
  }
}
