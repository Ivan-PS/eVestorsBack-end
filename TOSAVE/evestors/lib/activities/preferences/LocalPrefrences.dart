import 'package:evestors/beans/UserBean.dart';
import 'package:shared_preferences/shared_preferences.dart';

import '../daos/UserDao.dart';

class LocalPreferences {
  // getters User
  Future<void> setUserId(int id) async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    prefs.setInt('userId', id);
  }

  Future<void> setUserName(String name) async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    prefs.setString('userName', name);
  }

  Future<void> setUserEmail(String email) async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    prefs.setString('userEmail', email);
  }

  Future<void> setUserPassword(String password) async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    prefs.setString('userPassword', password);
  }

  Future<void> setUserFirstName(String firstName) async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    prefs.setString('userFirstName', firstName);
  }

  Future<void> setUserSecondName(String secondName) async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    prefs.setString('userSecondName', secondName);
  }

  Future<void> setUserType(int type) async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    prefs.setInt('userType', type);
  }

  Future<void> setUserSessionToken(String sessionToken) async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    prefs.setString('userSetSessionToken', sessionToken);
  }

  // setters User
  Future<int> getUserId() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    return prefs.getInt('userId') ?? 0;
  }

  Future<String> getUserName() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    return prefs.getString('userName') ?? '';
  }

  Future<String> getUserEmail() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    return prefs.getString('userEmail') ?? '';
  }

  Future<String> getUserPassword() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    return prefs.getString('userPassword') ?? '';
  }

  Future<String> getUserFirstName() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    return prefs.getString('userFirstName') ?? '';
  }

  Future<String> getUserSecondName() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    return prefs.getString('userSecondName') ?? '';
  }

  Future<int> getUserType() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    return prefs.getInt('userType') ?? 0;
  }

  Future<String> getUserSessionToken() async {
    SharedPreferences prefs = await SharedPreferences.getInstance();
    return prefs.getString('userSessionToken') ?? "";
  }

  Future<UserDao> getSavedUser() async {
    int id = await getUserId();
    String name = await getUserName();
    String email = await getUserEmail();
    String firstName = await getUserFirstName();
    String secondName = await getUserSecondName();
    int type = await getUserType();
    String sessionToken = await getUserSessionToken();

    return UserDao(id, name, email, firstName, secondName, type, sessionToken);
  }
}
