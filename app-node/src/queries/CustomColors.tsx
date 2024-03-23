import { gql } from "@apollo/client";

export const CustomColorsQuery = gql`
  {
    customColors {
      headerColor
      pageColor
    }
  }
`;