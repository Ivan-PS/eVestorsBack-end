import 'dart:convert';

import 'package:http/http.dart' as http;

class ResponseDecoder {
  Map<String, dynamic> body = {};
  int status = 0;

  ResponseDecoder decodeResponse(http.Response res) {
    body = json.decode(res.body);
    status = res.statusCode;
    return this;
  }

  @override
  String toString() {
    // TODO: implement toString
    return "body: ${body.toString()} status: ${status.toString()}";
  }
}
