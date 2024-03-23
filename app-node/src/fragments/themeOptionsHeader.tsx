import { useQuery, gql } from "@apollo/client";

export const ThemeOptionsHeaderFragment = gql`
  fragment ThemeOptionsHeaderFragment on ThemeOptionsHeader {
    categoriesList
  }
`;