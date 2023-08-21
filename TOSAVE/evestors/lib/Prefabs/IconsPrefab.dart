import 'package:evestors/Utils/DefaultColors.dart';
import 'package:flutter/cupertino.dart';

class IconsPrefab {
  static Widget defaultIcon(BuildContext context, IconData icon) {
    return Icon(icon, color: DefaultColors.primary);
  }

  Widget iconWithTextAction(
      BuildContext context, IconData icon, String text, Function() onPess) {
    return Container(
      child: GestureDetector(
          onTap: onPess,
          child: Column(
            children: [
              Icon(
                icon,
                size: 120.0,
                color: DefaultColors.primary,
              ),
              Text(
                text,
                style: TextStyle(fontSize: 20.0, color: DefaultColors.black),
              )
            ],
          )),
    );
  }
}
