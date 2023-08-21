import 'package:evestors/Utils/DefaultColors.dart';
import 'package:flutter/cupertino.dart';
import 'package:fluttertoast/fluttertoast.dart';

class Toast {
  static showToast(BuildContext context, Color color, String text) {
    Fluttertoast.showToast(
        msg: text,
        gravity: ToastGravity.CENTER,
        timeInSecForIosWeb: 1,
        backgroundColor: color,
        textColor: DefaultColors.white,
        fontSize: 16.0);
  }
}
