import 'package:flutter/cupertino.dart';

import '../Utils/DefaultColors.dart';

class TextPrefab {
  static Widget titleText(BuildContext context, String text) {
    return Text(
      text,
      style: TextStyle(
          fontSize: 20.0,
          fontWeight: FontWeight.bold,
          color: DefaultColors.black),
    );
  }

  static Widget headerTitleText(BuildContext context, String text) {
    return Text(
      textAlign: TextAlign.center,
      text,
      style: TextStyle(
          fontSize: 20.0,
          fontWeight: FontWeight.bold,
          color: DefaultColors.black),
    );
  }

  static Widget subTitleText(BuildContext context, String text) {
    return Text(
      text,
      style: TextStyle(fontSize: 15.0, color: DefaultColors.softBlack),
    );
  }

  static Widget defaultClickableTextSmall(
      BuildContext context, String text, Function() onTap) {
    return GestureDetector(
      onTap: onTap,
      child: Text(
        text,
        style: TextStyle(
            fontSize: 13.0,
            fontWeight: FontWeight.bold,
            color: DefaultColors.primary),
      ),
    );
  }

  static Widget smallText(BuildContext context, String text) {
    return Text(
      text,
      style: TextStyle(fontSize: 15.0, color: DefaultColors.black),
    );
  }

  static Widget mediumText(BuildContext context, String text) {
    return Text(
      text,
      style: TextStyle(fontSize: 18.0, color: DefaultColors.black),
    );
  }
}
