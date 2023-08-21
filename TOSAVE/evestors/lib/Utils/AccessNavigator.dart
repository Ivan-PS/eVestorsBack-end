import 'package:evestors/activities/MainActivity.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';

class AccessNavigator {
  static void accessTo(BuildContext context, Widget accessTo) {
    Navigator.push(
      context,
      MaterialPageRoute(builder: (context) => accessTo),
    );
  }

  static void goBack(BuildContext context) {
    Navigator.pop(context);
  }

  static void accessAndReplaceTo(BuildContext context, Widget accessTo) {
    Navigator.pushReplacement(
      context,
      MaterialPageRoute(builder: (context) => accessTo),
    );
  }

  static void accessAndReplaceToNoAnimation(
      BuildContext context, Widget accessTo) {
    Navigator.pushReplacement(
      context,
      PageRouteBuilder(
        pageBuilder: (context, animation1, animation2) => accessTo,
        transitionDuration: Duration.zero,
        reverseTransitionDuration: Duration.zero,
      ),
    );
  }
}
