import 'package:evestors/Prefabs/ButtonPrefab.dart';
import 'package:evestors/Prefabs/IconsPrefab.dart';
import 'package:evestors/Prefabs/TextPrefab.dart';
import 'package:evestors/Utils/AccessNavigator.dart';
import 'package:evestors/Utils/DefaultColors.dart';
import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';

class HeaderPrefab {
  static Widget defaultHeader(BuildContext context, String text) {
    return Container(
        margin: const EdgeInsets.only(top: 10.0),
        decoration: BoxDecoration(
            border: Border(
                bottom: BorderSide(width: 4, color: DefaultColors.primary))),
        child: Padding(
          padding: const EdgeInsets.only(top: 30, bottom: 10),
          child: Row(children: [
            ButtonPrefab.defaultIconButton(
                IconsPrefab.defaultIcon(context, Icons.arrow_back_ios_outlined),
                () => AccessNavigator.goBack(context)),
            Padding(
                padding: EdgeInsets.only(left: 90),
                child: TextPrefab.headerTitleText(context, text)),
          ]),
        ));
  }

  static Widget defaultHeaderNoTextNoBorder(BuildContext context) {
    return Container(
        margin: const EdgeInsets.only(top: 10.0),
        child: Padding(
          padding: const EdgeInsets.all(20.0),
          child: Row(children: [
            ButtonPrefab.defaultIconButton(
                IconsPrefab.defaultIcon(context, Icons.arrow_back_ios_outlined),
                () => AccessNavigator.goBack(context)),
          ]),
        ));
  }

  static Widget defaultOnlyText(BuildContext context, String text) {
    return Container(
        margin: const EdgeInsets.only(top: 10.0),
        decoration: BoxDecoration(
            border: Border(
                bottom: BorderSide(width: 4, color: DefaultColors.primary))),
        child: Padding(
          padding: const EdgeInsets.only(top: 45, bottom: 25),
          child: Align(
            alignment: Alignment.center,
            child: Row(
                mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                crossAxisAlignment: CrossAxisAlignment.center,
                children: [
                  TextPrefab.headerTitleText(context, text),
                ]),
          ),
        ));
  }
}
