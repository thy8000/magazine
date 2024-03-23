import { useQuery, gql } from "@apollo/client";

export const CustomColorsFragment = gql`
  fragment CustomColorsFragment on CustomColors {
    headerColor
    pageColor
  }
`;