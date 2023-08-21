import 'package:evestors/WebService/RequestMaker.dart';
import 'package:http/src/response.dart';

class WebService {
  // static const HOST = "https://ed44-79-157-41-95.ngrok-free.app/api/";
  static final HOST = "http://192.168.1.59:8000/api/";

  static const USER = "user/";
  static const FOLDER = "folder/";
  static const FILE = "file/";
  static const STARTUP = "startUp/";
  static const PERMISION = "permision/";
  static const INVERSION = "inversion/";
  static const INVERSIOR = "inversior/";
  static const ACCESSCODE = "accesssCode/";

  static const LOGIN = "login/";
  static const REGISTER = "register/";

  static const CREATE = "create/";
  static const GET_BY_ID = "getById/";
  static const DELETE_BY_ID = "deleteById/";
  static const UPDATE_BY_ID = "updateId/";
  static const CHECK = "check/";
  static const GET_BY_STARTUPID = "getByStartUpId/";

  static const GET_BY_PARENT = "getByParent/";
  static const GET_BY_OWNER_ID = "getByOwnerId/";
  static const GET_BY_INVERSIOR_ID = "getByInversorId/";
  static const GET_ALLOWED = "getAllowed/";

  static const GET_IF_PERMISION_FOLDER = "getIfPermisionUserFolder/";
  static const GET_IF_PERMISION_FILE = "getIfPermisionUserFile/";

  static const USER_CREATE = USER + CREATE;
  static const USER_LOGIN = USER + LOGIN;
  static const USER_REGISTER = USER + REGISTER;
  static const USER_GET_BY_ID = USER + GET_BY_ID;

  static const FOLDER_CREATE = FOLDER + CREATE;
  static const FOLDER_GET_BY_ID = FOLDER + GET_BY_ID;
  static const FOLDER_DELETE_BY_ID = FOLDER + DELETE_BY_ID;
  static const FOLDER_GET_BY_PARENT = FOLDER + GET_BY_PARENT;
  static const FOLDER_GET_ALLOWED = FOLDER + GET_ALLOWED;

  static const INVERSION_CREATE = INVERSION + CREATE;
  static const INVERSION_GET_BY_ID = INVERSION + GET_BY_ID;
  static const INVERSION_DELETE_BY_ID = INVERSION + DELETE_BY_ID;
  static const INVERSION_GET_BY_INVERSOR_ID = INVERSION + GET_BY_INVERSIOR_ID;
  static const INVERSION_UPDATE_BY_ID = INVERSION + UPDATE_BY_ID;

  static const FILE_CREATE = FILE + CREATE;
  static const FILE_GET_BY_ID = FILE + GET_BY_ID;
  static const FILE_DELETE_BY_ID = FILE + DELETE_BY_ID;
  static const FILE_GET_BY_PARENT = FILE + GET_BY_PARENT;

  static const INVERSOR_CREATE = INVERSIOR + CREATE;
  static const ACCESSCODE_CREATE = ACCESSCODE + CREATE;
  static const ACCESSCODE_GETBYSTARTUPID = ACCESSCODE + GET_BY_STARTUPID;
  static const ACCESSCODE_CHECK = ACCESSCODE + CHECK;

  static const PERMISION_CREATE = PERMISION + CREATE;
  static const PERMISION_DELETE_BY_ID = PERMISION + DELETE_BY_ID;
  static const PERMISION_GET_IF_PERMISION_FOLDER =
      PERMISION + GET_IF_PERMISION_FOLDER;
  static const PERMISION_GET_IF_PERMISION_FILE =
      PERMISION + GET_IF_PERMISION_FILE;

  static const STARTUP_CREATE = STARTUP + CREATE;
  static const STARTUP_GET_ALLOWED = STARTUP + GET_ALLOWED;

  // static final LOGIN = "login/";

  // static final GET = "get/";

  /*static final USER_CREATE = USER + CREATE;
  static final USER_GET = USER + GET;
  static final USER_LOGIN = USER + LOGIN;

  static final FOLDER_GET = FOLDER + GET;
  static final FOLDER_USER_CREATE = FOLDER + USER + CREATE;
  static final FOLDER_USER_GET = FOLDER + USER + GET;

  static final FILE_USER_CREATE = FILE + USER + CREATE;
  static final FILE_USER_GET = FILE + USER + GET;*/

  Future<Response> createUser(String name, String pass, String email,
      String firstName, String secondName, int type) async {
    String url = HOST + USER_CREATE;
    Map<String, String> body = {
      "name": name,
      "password": pass,
      "email": email,
      "firstName": firstName,
      "secondName": secondName,
      "type": type.toString()
    };
    print("url Create User " + url);
    print("body Create User: " + body.toString());

    return RequestMaker().post(url, body, false);
  }

  Future<Future<Response>> getUserGetById(id) async {
    String url = HOST + USER_GET_BY_ID;
    Map<String, String> body = {"id": id};
    return RequestMaker().post(url, body, false);
  }

  Future<Response> loginUser(String email, String password) async {
    String url = HOST + USER_LOGIN;
    Map<String, String> body = {"email": email, "password": password};
    return RequestMaker().post(url, body, false);
  }

  Future<Response> createFolder(int idUser, String name, String description,
      String path, int parent, int startUpId) async {
    String url = HOST + FOLDER_CREATE;
    Map<String, String> body = {
      "idUser": idUser.toString(),
      "name": name,
      "description": description,
      "path": path,
      "parent": parent.toString(),
      "startup_id": startUpId.toString()
    };
    return RequestMaker().post(url, body, false);
  }

  Future<Response> getFolders(int idUser, int parent, int startUpId) async {
    String url = HOST + FOLDER_GET_BY_PARENT;
    Map<String, String> body = {
      "idUser": idUser.toString(),
      "parent": parent.toString(),
      "startup_id": startUpId.toString()
    };
    return RequestMaker().post(url, body, false);
  }

  Future<Response> getFoldersAllowed(
      int idUser, int parent, int startUpId) async {
    String url = HOST + FOLDER_GET_ALLOWED;
    Map<String, String> body = {
      "idUser": idUser.toString(),
      "parent": parent.toString(),
      "startup_id": startUpId.toString()
    };
    return RequestMaker().post(url, body, false);
  }

  Future<Response> createStartUp(
      int idUser, String name, String description) async {
    String url = HOST + STARTUP_CREATE;
    Map<String, String> body = {
      "idUser": idUser.toString(),
      "name": name,
      "description": description,
    };
    return RequestMaker().post(url, body, false);
  }

  Future<Response> getStartupsAllowed(int idUser) async {
    String url = HOST + STARTUP_GET_ALLOWED;
    Map<String, String> body = {
      "idUser": idUser.toString(),
    };
    return RequestMaker().post(url, body, false);
  }

  Future<Response> genereateAccessCode(int startup_id) async {
    String url = HOST + ACCESSCODE_CREATE;
    Map<String, String> body = {'startup_id': startup_id.toString()};
    return RequestMaker().post(url, body, false);
  }

  Future<Response> getAccessCode(int startup_id) async {
    String url = HOST + ACCESSCODE_GETBYSTARTUPID;
    Map<String, String> body = {'startup_id': startup_id.toString()};
    return RequestMaker().post(url, body, false);
  }

  Future<Response> checkAccessCode(int userId, String accessCode) async {
    String url = HOST + ACCESSCODE_CHECK;
    Map<String, String> body = {
      'idUser': userId.toString(),
      'accessCode': accessCode.toString()
    };
    return RequestMaker().post(url, body, false);
  }

  Future<Response> createInversor(
      int idUser, int startup_id, int accessCode) async {
    String url = HOST + INVERSOR_CREATE;
    Map<String, String> body = {
      "idUser": idUser.toString(),
      "startup_id": startup_id.toString(),
      "accessCode": accessCode.toString(),
    };
    return RequestMaker().post(url, body, false);
  }

/*
  Future<Response> getUserFolder(int idUser) async {
    String url = HOST + FOLDER_USER_GET;
    Map<String, String> body = {"idUser": idUser.toString()};
    return RequestMaker().post(url, body, false);
  }

  Future<Response> createUserFile(
      int idUser, String name, String description) async {
    String url = HOST + FILE_USER_CREATE;
    Map<String, String> body = {
      "idUser": idUser.toString(),
      "name": name,
      "description": description
    };
    return RequestMaker().post(url, body, false);
  }

  Future<Response> getUserFile(int idUser) async {
    String url = HOST + FILE_USER_GET;
    Map<String, String> body = {"idUser": idUser.toString()};
    return RequestMaker().post(url, body, false);
  }*/
}
